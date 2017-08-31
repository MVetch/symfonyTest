<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle;

/**
 * Contains all events thrown in the FOSUserBundle.
 */
final class FOSUserEvents
{
    /**
     * The CHANGE_PASSWORD_INITIALIZE event occurs when the change password process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     *
     * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
     */
    const CHANGE_PASSWORD_INITIALIZE = 'Изменение пароля';

    /**
     * The CHANGE_PASSWORD_SUCCESS event occurs when the change password form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     *
     * @Event("FOS\UserBundle\Event\FormEvent")
     */
    const CHANGE_PASSWORD_SUCCESS = 'Пароль изменен';

    /**
     * The CHANGE_PASSWORD_COMPLETED event occurs after saving the user in the change password process.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterUserResponseEvent")
     */
    const CHANGE_PASSWORD_COMPLETED = 'Пароль изменен';

    /**
     * The GROUP_CREATE_INITIALIZE event occurs when the group creation process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     *
     * @Event("FOS\UserBundle\Event\GroupEvent")
     */
    const GROUP_CREATE_INITIALIZE = 'fos_user.group.create.initialize';

    /**
     * The GROUP_CREATE_SUCCESS event occurs when the group creation form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     *
     * @Event("FOS\UserBundle\Event\FormEvent")
     */
    const GROUP_CREATE_SUCCESS = 'fos_user.group.create.success';

    /**
     * The GROUP_CREATE_COMPLETED event occurs after saving the group in the group creation process.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterGroupResponseEvent")
     */
    const GROUP_CREATE_COMPLETED = 'fos_user.group.create.completed';

    /**
     * The GROUP_DELETE_COMPLETED event occurs after deleting the group.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterGroupResponseEvent")
     */
    const GROUP_DELETE_COMPLETED = 'fos_user.group.delete.completed';

    /**
     * The GROUP_EDIT_INITIALIZE event occurs when the group editing process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     *
     * @Event("FOS\UserBundle\Event\GetResponseGroupEvent")
     */
    const GROUP_EDIT_INITIALIZE = 'fos_user.group.edit.initialize';

    /**
     * The GROUP_EDIT_SUCCESS event occurs when the group edit form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     *
     * @Event("FOS\UserBundle\Event\FormEvent")
     */
    const GROUP_EDIT_SUCCESS = 'fos_user.group.edit.success';

    /**
     * The GROUP_EDIT_COMPLETED event occurs after saving the group in the group edit process.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterGroupResponseEvent")
     */
    const GROUP_EDIT_COMPLETED = 'fos_user.group.edit.completed';

    /**
     * The PROFILE_EDIT_INITIALIZE event occurs when the profile editing process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     *
     * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
     */
    const PROFILE_EDIT_INITIALIZE = 'Профиль изменен';

    /**
     * The PROFILE_EDIT_SUCCESS event occurs when the profile edit form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     *
     * @Event("FOS\UserBundle\Event\FormEvent")
     */
    const PROFILE_EDIT_SUCCESS = 'Профиль изменен';

    /**
     * The PROFILE_EDIT_COMPLETED event occurs after saving the user in the profile edit process.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterUserResponseEvent")
     */
    const PROFILE_EDIT_COMPLETED = 'Профиль изменен';

    /**
     * The REGISTRATION_INITIALIZE event occurs when the registration process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const REGISTRATION_INITIALIZE = 'Регистрация';

    /**
     * The REGISTRATION_SUCCESS event occurs when the registration form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     *
     * @Event("FOS\UserBundle\Event\FormEvent")
     */
    const REGISTRATION_SUCCESS = 'Success';

    /**
     * The REGISTRATION_FAILURE event occurs when the registration form is not valid.
     *
     * This event allows you to set the response instead of using the default one.
     * The event listener method receives a FOS\UserBundle\Event\FormEvent instance.
     *
     * @Event("FOS\UserBundle\Event\FormEvent")
     */
    const REGISTRATION_FAILURE = 'Failure';

    /**
     * The REGISTRATION_COMPLETED event occurs after saving the user in the registration process.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterUserResponseEvent")
     */
    const REGISTRATION_COMPLETED = 'Complete';

    /**
     * The REGISTRATION_CONFIRM event occurs just before confirming the account.
     *
     * This event allows you to access the user which will be confirmed.
     *
     * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
     */
    const REGISTRATION_CONFIRM = 'Регистрация утверждена';

    /**
     * The REGISTRATION_CONFIRMED event occurs after confirming the account.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterUserResponseEvent")
     */
    const REGISTRATION_CONFIRMED = 'Регистрация подтверждена';

    /**
     * The RESETTING_RESET_REQUEST event occurs when a user requests a password reset of the account.
     *
     * This event allows you to check if a user is locked out before requesting a password.
     * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
     *
     * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
     */
    const RESETTING_RESET_REQUEST = 'fos_user.resetting.reset.request';

    /**
     * The RESETTING_RESET_INITIALIZE event occurs when the resetting process is initialized.
     *
     * This event allows you to set the response to bypass the processing.
     *
     * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
     */
    const RESETTING_RESET_INITIALIZE = 'fos_user.resetting.reset.initialize';

    /**
     * The RESETTING_RESET_SUCCESS event occurs when the resetting form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     *
     * @Event("FOS\UserBundle\Event\FormEvent ")
     */
    const RESETTING_RESET_SUCCESS = 'fos_user.resetting.reset.success';

    /**
     * The RESETTING_RESET_COMPLETED event occurs after saving the user in the resetting process.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\FilterUserResponseEvent")
     */
    const RESETTING_RESET_COMPLETED = 'fos_user.resetting.reset.completed';

    /**
     * The SECURITY_IMPLICIT_LOGIN event occurs when the user is logged in programmatically.
     *
     * This event allows you to access the response which will be sent.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const SECURITY_IMPLICIT_LOGIN = 'fos_user.security.implicit_login';

    /**
     * The RESETTING_SEND_EMAIL_INITIALIZE event occurs when the send email process is initialized.
     *
     * This event allows you to set the response to bypass the email confirmation processing.
     * The event listener method receives a FOS\UserBundle\Event\GetResponseNullableUserEvent instance.
     *
     * @Event("FOS\UserBundle\Event\GetResponseNullableUserEvent")
     */
    const RESETTING_SEND_EMAIL_INITIALIZE = 'fos_user.resetting.send_email.initialize';

    /**
     * The RESETTING_SEND_EMAIL_CONFIRM event occurs when all prerequisites to send email are
     * confirmed and before the mail is sent.
     *
     * This event allows you to set the response to bypass the email sending.
     * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
     *
     * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
     */
    const RESETTING_SEND_EMAIL_CONFIRM = 'fos_user.resetting.send_email.confirm';

    /**
     * The RESETTING_SEND_EMAIL_COMPLETED event occurs after the email is sent.
     *
     * This event allows you to set the response to bypass the the redirection after the email is sent.
     * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
     *
     * @Event("FOS\UserBundle\Event\GetResponseUserEvent")
     */
    const RESETTING_SEND_EMAIL_COMPLETED = 'fos_user.resetting.send_email.completed';

    /**
     * The USER_CREATED event occurs when the user is created with UserManipulator.
     *
     * This event allows you to access the created user and to add some behaviour after the creation.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const USER_CREATED = 'Пользователь создан';

    /**
     * The USER_PASSWORD_CHANGED event occurs when the user is created with UserManipulator.
     *
     * This event allows you to access the created user and to add some behaviour after the password change.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const USER_PASSWORD_CHANGED = 'Пароль изменен';

    /**
     * The USER_ACTIVATED event occurs when the user is created with UserManipulator.
     *
     * This event allows you to access the activated user and to add some behaviour after the activation.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const USER_ACTIVATED = 'Пользователь активирован';

    /**
     * The USER_DEACTIVATED event occurs when the user is created with UserManipulator.
     *
     * This event allows you to access the deactivated user and to add some behaviour after the deactivation.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const USER_DEACTIVATED = 'Пользователь деактивирован';

    /**
     * The USER_PROMOTED event occurs when the user is created with UserManipulator.
     *
     * This event allows you to access the promoted user and to add some behaviour after the promotion.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const USER_PROMOTED = 'fos_user.user.promoted';

    /**
     * The USER_DEMOTED event occurs when the user is created with UserManipulator.
     *
     * This event allows you to access the demoted user and to add some behaviour after the demotion.
     *
     * @Event("FOS\UserBundle\Event\UserEvent")
     */
    const USER_DEMOTED = 'fos_user.user.demoted';
}
