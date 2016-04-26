<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    // Models



    // Accion
    'action' => 'Action',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'addModel' => 'Add :currentModelName',
    'editModel' => 'Edit :currentModelName',
    'updateModel' => 'Update :currentModelName',
    'deleteAllElements' => 'Delete all elements',


    //Common
    'preview' => ' Preview',
    'thanks' => ' Thanks',


    //Tournament
    'tournament' => 'Tournament|Tournaments',
    'newTournament' => 'New Tournament',
    'createTournament' => 'Create Tournament',
    'date' => 'Date',
    'eventDate' => 'Event date',
    'account' => 'Account',
    'limitDateRegistration' => 'Deadline Registration Date',
    'teamSize' => 'Team Size',
    'fightingAreas' => 'Num of Areas',
    'fightDuration' =>'Duration',
    'hasRoundRobin' => 'Round Robin',
    'roundRobinWinner' => 'Winner x Round Robin',
    'hasEncho' => 'Encho?',
    'hasHantei' => 'Hantei?',
    'general_data' => 'General Data',
    'level' => 'Level',
    'cost' => 'Cost',
    'settings' => 'Parameters',
    'pay4register' => 'Must pay to compete?',
    'latitude' => 'Latitude',
    'longitude' => 'Longitude',
    'tournamentType' => 'Tournament Type',
    'owner' => 'Owner',
    'see_competitors' => 'See competitors',
    'general' => 'General',
    'certificates' => 'Certifications',
    'acredit' => 'Acreditations',
    'broadcast' => 'Transmit',
    'publish' => 'Publish',
    'invite_competitors' => 'Invite competitors',
    'generate_trees' => 'Generate Docs',
//    'admin_tournaments' => 'Manage Tournaments',
    'eventDateIni' => 'Initial Date',
    'eventDateFin' => 'Final Date',
    'from' => 'From',
    'to' => 'To',
    'competitors_register' => 'Competitors registration',
    'configure' => 'Configure',
    'add_custom_category' => 'Add custom category',


    // Categories
    'category' => 'Category|Categories',
    'enchoQty' => 'How much Enchos?',
    'encho_infinite' => '0 for infinite',
    'enchoDuration' => '¿How long lasts each Encho?',
    'category_not_configured' => 'Category isn\'t configured yet',
    'add_category' => 'Add Category',
    'gender' => 'Gender',
    'male' => 'Men',
    'female' => 'Ladies',
    'mixt' => 'Mixed',
    'ageCategory' => 'Age Category',
    'no_age_restriction' => 'No age limit',
    'children' => 'Children',
    'students' => 'Students',
    'adults' => 'Adults',
    'masters' => 'Masters',
    'custom' => 'Custom',
    'years' => 'years',
    'age' => 'Age',
    'min_age' => 'Min Age',
    'max_age' => 'Max Age',
    'min_grade' => 'Min Grade',
    'max_grade' => 'Max Grade',
    'no_grade_restriction' => 'No grade limit',
    'add_and_close' => 'Add',
    'add_and_new' => 'Add and New',
    'first_force' => 'First Force ( >1Dan )',
    'second_force' => 'Second Force ( <1Dan)',


    // CategorySetting
    'categorySettings' => 'Categories Settings',
    'isTeam' => 'Team',
    'single' => 'Single',


    // Places
    'venue' => 'Venue',
    'place' => 'Place|Places',
    'coords' => 'Coords',
    'city' => 'City',
    'state' => 'State',
    'country' => 'Country',
    'location' => 'Location',

    // Nivel
    'local' => 'Local',
    'district' => 'District',
    'level_city' => 'Municipal',
    'regional' => 'Regional',
    'level_state' => 'State',
    'national' => 'National',
    'international' => 'International',



    // User
    'user' => 'User|Users',
    'name' => 'Name',
    'username' => 'Username',
    'profile' => 'Profile',
    'grade' => 'Grade',
    'avatar' => 'Avatar',
    'email' => 'Email',
    'email_desc' => 'Email linked to your account',
    'role' => 'Role',
    'firstname' => 'First name',
    'lastname' => 'Last name',
    'password' => 'Password',
    'newpassword' => 'New password',
    'conewpassword' => 'Confirm new password',
    'without_grade' => 'No grade',
    'left_password_blank' => 'If you don\'t want to change password... please leave them empty',
    'remove' => 'Remove',



    // Competitor
    'competitor' => 'Competitor|Competitors',
    'add_competitor' => 'Add Competitor',
    'add_competitor_to_category' => 'Add competitor to category: :category',
    'select_competitor_categories' => 'Select the categories in which you want to register the competitor',
    'select_tournament_categories' => 'Select the open categories for the tournament
',



    // Invitation

    'invitation' => 'Invitation|Invitations',
    'tournament_invitations' => 'Invite competitors',
    'invite_send' => 'Invite competitors to tournament: :tournament',
    'recipients' => 'Recipients',
    'invite_recipients' => 'Write all the recipients separated by comas',
    'invite_message' => 'Invitation message',
    'invite_template' => "Click the link para register tournament: :tournament \n :link ",
    'send_invites' => 'Send Invites',
    'invite_with_link' => 'Invite competitors with that link',
    'no_tournament_registered_yet' => 'Not registered in any tournament yet',
    'no_invitation_yet' => 'You have not been invited to any tournament yet',

    'confirmed' => 'Confirmed',
    'used' => 'Used',
    'results' => 'results',
    'latest_competitors' => 'Latest Competitors',
    'organizer' => 'Organizer',
    'select_categories_to_register' => 'Select categories to register',

//    'tournament_categories_available' => 'Categorias del torneo',



    // Messages
    'all_categories_not_configured' => 'All categories must be configured first.',


    // Share
    'share' => 'Share',

    // Dashboard

//    'controlpanel' => 'Configuración',
//    'myaccount' => 'Mi Cuenta',
//    'groups' => 'Grupos de usuarios',
//    'blastmail' => 'Correo Másivo',
    'logs' => 'Logs',
    'dashboard' => 'Dashboard',
    'logout' => 'Logout',
    'home' => 'Home',
//    'personalinfo' => 'Información personal',
    'changepassword' => 'Change my password',
    'savechanges' => 'Save changes',
    'all_fields_required' => 'All fields are required',
    'error' => 'Error',
    'warning' => 'Warning',
    'success' => 'Success',
    'info' => 'Info',
    'information' => 'Information',
    'operation_successful' => ' Operation Successful',
    'operation_failed' => ' Operation failed',
    'save' => 'Save',
    'help' => 'Help',
    'type' => 'Type',
    'open' => 'Open',
    'yes' => 'Yes',
    'no' => 'No',
    'forbidden' => 'Forbidden!',



    // Left menu
    'lastlogin' => 'Last Login',
//    'users' => 'Usuarios',
//    'statistics' => 'Estadisticas',

    // Right Menu

    'sumary' => 'Summary',
    //Settings

    'social_networks' => 'Social Networks',


    // Dashboard
    'welcome' => '¡Welcome!',
    'welcome_text' => 'Almost there! You still need a few steps to enjoy the App',
    'still_no_tournament' => 'Still not registered in any tournaments',
    'create_new_tournament' => 'Create new Tournament',
    'congigure_categories' => 'Setup Categories',
//    'see_open_tournaments' => 'Ver torneos abiertos',
    'soon' => 'Soon',
    'configured' => 'conf.',
    'configured_full' => 'configured',
    'see_all' => 'See all',
    'no_tournament_created_yet' => 'You have not registered to any tournament yet',
    'no_tournament_deleted_yet' => 'You have not deleted any tournament yet',

    'join_tournament' => 'Join existing tournament',
    'tournaments_registered' => 'Tournament records',
    'tournaments_created' => 'Tournaments created',
    'tournaments_deleted' => 'Tournaments deleted',
    'numbers' => 'Numbers',
    'created' => 'Created',
    'participations' => 'Participacions',
    'past' => 'Past',
    'next' => 'Next',
];
