<?php namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Utilities\BriceHacheController;
use App\Http\Requests\ConfirmPasswordRequest;
use App\Mail\Register;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ForgotRequest;
use stdClass;
use App\Mail\ForgotPassword;

class AuthController extends BriceHacheController
{
    /**
     * Authentification.
     *
     * @return View
     */

    //Par défaut, l'utilisateur est désactivé
    private $user_activation = false;


    public function getSignin()
    {
        $result['template_settings'] = $this->global_settings->gettemplateSettings();

        // L'utilisateur s'est-il authentifié ?
        if (Sentinel::check()) {
            return Redirect::route('admin.dashboard');
        }

        // Afficher la page d'authentification le cas contraire
        return view('admin.auth.login')->with('result', $result);
    }

    /**
     * Processus d'authentification.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSignin(Request $request)
    {

        try {
            // Essai d'authentification
            if ($user = Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', 0))) {
                // Redirection vers le tableau de bord
                //On peux mettre ceci dans le journal des activités. Ecrire le code ici
                return Redirect::route("admin.dashboard")->with('success', trans('auth/message.signin.success'));
            }

            $this->messageBag->add('email', trans('auth/message.account_not_found'));
        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_not_activated'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', trans('auth/message.account_suspended', compact('delay')));
        }

        // Ooops.. Quelque chose d'anormal s'est produit
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Processus d'enregistrement
     *
     * @return Redirect
     */
    public function postSignup(UserRequest $request)
    {
        $activate = $this->user_activation;

        try {
            // Enregistrement de l'utilisateur
            $user = Sentinel::register(
                [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                ],
                $activate
            );
            // Effectuer une authentification automatique après l'enregistrement
            $role = Sentinel::findRoleById(2);
            //Ajout du role 'User' à l'utilisateur en question

            $role->users()->attach($user);

            // si l'utilisateur n'a pas encore été activé
            if (!$activate) {
                // Données à utiliser pour le mail d'activation du compte
                // Nom complet de l'utilisateur
                //url d'activation avec le code d'activation

                $data=[
                    'user_name' => $user->first_name .' '. $user->last_name,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                ];
                // Envoi du code d'activation par mail
                Mail::to($user->email)
                    ->send(new Register($data));

                //Redirection sur la page d'authentification
                return redirect('admin.login')->with('success', trans('auth/message.signup.success'));
            }

            // Authentifier l'utilsateur au cas où il s'est déja activé
            Sentinel::login($user, false);

            //Journaliser cette activité ? Ecrire le code ici

            // Aller au tableau de bord avec un message de succès
            return Redirect::route("admin.dashboard")->with('success', trans('auth/message.signup.success'));
        } catch (UserExistsException $e) {
            $this->messageBag->add('email', trans('auth/message.account_already_exists'));
        }

        // Ooops.. Quelque chose d'anormal s'est produit
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Page d'activation de l'utilisateur
     *
     * @param  number $userId
     * @param  string $activationCode
     * @return
     */
    public function getActivate($userId, $activationCode = null)
    {
        // L'utilisateur s'est-il authentifié ?
        if (Sentinel::check()) {
            return Redirect::route('admin.dashboard');
        }

        $user = Sentinel::findById($userId);
        $activation = Activation::create($user);

        if (Activation::complete($user, $activation->code)) {
            // Activation avec succès
            // Redirection vers la page d'authentification
            return Redirect::route('signin')->with('success', trans('auth/message.activate.success'));
        } else {
            // Activation non trouvée ou  non complète.
            $error = trans('auth/message.activate.error');
            return Redirect::route('signin')->with('error', $error);
        }
    }

    /**
     * Mot de passe oublié - réinitialisation en utilisant un code.
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function postForgotPassword(ForgotRequest $request)
    {
        $data = new stdClass();

        try {
            // Code d'activation rattaché au mot de passe oublié

            $user = Sentinel::findByCredentials(['email' => $request->get('email')]);

            if (!$user) {
                return back()->with('error', trans('auth/message.account_email_not_found'));
            }
            $activation = Activation::completed($user);
            if (!$activation) {
                return back()->with('error', trans('auth/message.account_not_activated'));
            }
            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            // Données à utiliser pour l'envoi du mail

            $data->user_name = $user->first_name .' ' .$user->last_name;
            $data->forgotPasswordUrl = URL::route('forgot-password-confirm', [$user->id, $reminder->code]);

            // Envoi du code d'activation par mail

            Mail::to($user->email)
                ->send(new ForgotPassword($data));
        } catch (UserNotFoundException $e) {
            // Même si le mail n'a pas été trouvé, Nous prétendons
            //// avoir envoyé le code de réinitialisation du mot de passe par mail,
            // C'est une mesure de sécurité contre les hackers.
        }

        //  Redirection vers la page de réinitialisation du mot de passe
        return back()->with('success', trans('auth/message.forgot-password.success'));
    }

    /**
     * Page de confirmation de la réinitialisation du mot de passe.
     *
     * @param  number $userId
     * @param  string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm($userId, $passwordResetCode = null)
    {
        //recherche de l'utilisateur utilisant le code de réinitialisation du mot de passe
        if (!$user = Sentinel::findById($userId)) {
            // Redirection vers la page de réinitialisation du mot de passe
            return Redirect::route('forgot-password')->with('error', trans('auth/message.account_not_found'));
        }
        if ($reminder = Reminder::exists($user)) {
            if ($passwordResetCode == $reminder->code) {
                return view('admin.auth.forgot-password-confirm');
            } else {
                return 'code does not match';
            }
        } else {
            return 'does not exists';
        }

        // Afficher la page
        // return View('admin.auth.forgot-password-confirm');
    }

    /**
     * Formulaire de réinitialisation du mot de passe.
     *
     * @param  Request $request
     * @param  number  $userId
     * @param  string  $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm(ConfirmPasswordRequest $request, $userId, $passwordResetCode = null)
    {

        //recherche de l'utilisateur utilisant le code de réinitialisation du mot de passe
        $user = Sentinel::findById($userId);
        if (!$reminder = Reminder::complete($user, $passwordResetCode, $request->get('password'))) {
            // Ooops.. Quelque chose d'anormal s'est produit
            return Redirect::route('signin')->with('error', trans('auth/message.forgot-password-confirm.error'));
        }

        //Mot de passe réinitialisé avec succès
        return Redirect::route('signin')->with('success', trans('auth/message.forgot-password-confirm.success'));
    }

    /**
     * Déconnexion
     *
     * @return Redirect
     */
    public function getLogout()
    {

        if (Sentinel::check()) {
            //Journalisation. Ecrire le code ici

            // Déconnexion
            Sentinel::logout();
        }


        // Redirection vers la page de connexion
        return redirect('admin/signin')->with('success', 'You have successfully logged out!');
    }

    /**
     * Deuxième méthode d'enregistrement d'un utilisateur
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function postRegister2(UserRequest $request)
    {

        try {
            // Enregistrement de l'utilisateur
            $user = Sentinel::registerAndActivate(
                [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),

                ]
            );

            //Ajout du role 'User' à l'utilisateur en question
            $role = Sentinel::findRoleById(2);
            $role->users()->attach($user);

            // Connecter l'utilisateur directement après l'enregistrement
            Sentinel::login($user, false);

            // Redirection vers le tableau de bord
            return Redirect::route("admin.dashboard")->with('success', trans('auth/message.signup.success'));
        } catch (UserExistsException $e) {
            $this->messageBag->add('email', trans('auth/message.account_already_exists'));
        }

        // Ooops.. quelque chose d'anormal s'est produit
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }
}
