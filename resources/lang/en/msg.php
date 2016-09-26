<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Defines all messages sent from flash
    |--------------------------------------------------------------------------
    |
    |
    */

    'user_already_registered_in_category' => 'The user is already registered to this category.',

    // Torneo
    'tournament_create_successful' => 'Tournament <b>:name</b><br/> created',
    'tournament_update_successful' => 'Tournament <b>:name</b><br/> updated',
    'tournament_delete_successful' => 'Tournament <b>:name</b><br/> deleted',
    'tournament_restored_successful' => 'Tournament <b>:name</b><br/> restored',

    'tournament_create_error' => 'Oooops! Error creating Tournament ',
    'tournament_update_error' => 'Oooops! Error updating Tournament ',
    'tournament_delete_error' => 'Error Deleting Tournament :name',
    'tournament_restored_error' => 'Error Restoring Tournament :name',


    // Usuario
    'user_create_successful' => 'User <br/> created',
    'user_update_successful' => 'User <br/> updated',
    'user_delete_successful' => 'User <br/> deleted',
    'user_restore_successful' => 'User <br/> restored',
    'user_registered_successful' => 'User <br/> were added to tournament :tournament',

    'user_create_error' => 'Oooops! Error creating User',
    'user_update_error' => 'Oooops! Error updating User',
    'user_delete_error' => 'Error deleting User',
    'user_restore_error' => 'Error restoring User',
    'user_registered_error' => 'Error registering User',

    'user_status_successful' => 'Status updated',
    'user_status_error' => 'Error updating :name',


    // Categoria
    'category_create_successful' => 'Category configured',
    'category_update_successful' => 'Category updated',
    'category_delete_successful' => 'Category deleted',

    'category_create_error' => 'Oooops! Category creation error',
    'category_update_error' => 'Oooops! Category update error',
    'category_delete_error' => 'Error deleting category :name',


    //Invitation

    'invitation_needed' => 'You need an invitation to register to this tournament.',
    'invitation_expired' => 'Registration date is due or invitation expired.',
    'invitation_used' => 'Invitation already used',
    'invitation_sent' => 'Invitations have been sent',
    'tx_for_register_tournament' => 'Thanks for register tournament :tournament',
    // Permisos
    'access_denied' => 'Access Denied',


    // Federation
    'federation_edit_successful' => 'Federation <br/><b>:name</b><br/> updated',


    //Association
    'association_create_successful' => 'Association <br/><b>:name</b><br/> created',
    'association_edit_successful' => 'Association <br/><b>:name</b><br/> updated',
    'association_delete_successful' => 'Association <br/><b>:name</b><br/> deleted',
    'association_delete_error' => 'Error deleting Association',
    'association_restored_successful' => 'Association <br/><b>:name</b><br/> restored',
    'association_restored_error' => 'Error restoring Association',

    //Club
    'club_create_successful' => 'Club <br/><b>:name</b><br/> created',
    'club_edit_successful' => 'Club <br/><b>:name</b><br/> updated',
    'club_delete_successful' => 'Club <br/><b>:name</b><br/> deleted',
    'club_delete_error' => 'Error deleting club',
    'club_restored_successful' => 'Club <br/><b>:name</b><br/> restored',
    'club_restored_error' => 'Error restoring club',


    'club_president_already_exists' => "User :user is already president of another club",
    'association_president_already_exists' => "User :user is already president of another association",
    'federation_president_already_exists' => "User :user is already president of another federation",

];
