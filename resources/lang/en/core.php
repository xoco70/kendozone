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
    'or' => 'or',
    'export_excel' => 'Export to Excel',
    'letsgo' => 'Let\'s do it',

    //Tournament
    'tournament' => 'Tournament|Tournaments',
    'newTournament' => 'New Tournament',
    'createTournament' => 'Create Tournament',
    'date' => 'Date',
    'eventDate' => 'Event date',
    'account' => 'Account',
    'limitDateRegistration' => 'Deadline Registration Date',
    'limitDate' => 'Limite Date',
    'general_data' => 'General Data',
    'level' => 'Level',
    'general_data_step1' => 'Enter the name and the date of your tournament',

    'settings' => 'Settings',

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
    'generate_tree' => 'Generate Tree',
    'eventDateIni' => 'Initial Date',
    'eventDateFin' => 'Final Date',
    'from' => 'From',
    'to' => 'To',
    'competitors_register' => 'Competitors registration',
    'configure' => 'Configure',
    
    'configured' => 'Configured',
    'add_custom_category' => 'Add a category',
    'rules' => 'Rules',
    'promoter' => 'Promoter',
    'host_organization' => 'Host Organization',
    'technical_assistance' => 'Technical Assistence',


     // Venue
    'venue' => 'Venue',
    'coords' => 'Coordinates',
    'address' => 'Address',
    'details' => 'Complementary Data',
    'city' => 'City',
    'CP' => 'Postal Code',
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
    'add_competitor_to_category' => 'Add competitor to category :category',
    'select_competitor_categories' => 'Select the categories in which you want to register the competitor',
    'select_tournament_categories' => 'Select the open categories for the tournament',
    'paid' => 'Paid',



    // Invitation

    'invitation' => 'Invitation|Invitations',
    'tournament_invitations' => 'Invite competitors',
    'invite_send' => 'Invite competitors to tournament: :tournament',
    'recipients' => 'Recipients',
    'invite_recipients' => 'Write all the recipients separated by comas',
    'invite_message' => 'Invitation message',
    'invite_template' => "Click the link to register tournament: :tournament \n :link ",
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

    '2_choices_to_invite' => 'Tienes 2 opciones para invitar competidores:',
    'invite_by_commas' => 'Ingresando el email de los competidores separandolos por commas',
    'invite_by_excel' => 'Importando un archivo excel ( El archivo debe contener un email por linea en la primera columna )',


    // Messages
    'all_categories_not_configured' => 'All categories must be configured first.',


    // Share
    'share' => 'Share',
    'share_link' => 'Share link',

    // Dashboard

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
    'see_trees' => 'Trees',
    //Settings

    'social_networks' => 'Social Networks',


    // Dashboard
    'welcome' => '¡Welcome!',
    'welcome_text1' => 'Almost there! You still need a few steps to enjoy the App',
    'welcome_text2' => 'What do you want to do?',

    'still_no_tournament' => 'Still not registered in any tournaments',
    'still_no_open_tournament' => 'Still no open tournaments in your country',
    'create_new_tournament' => 'Create new Tournament',
    'congigure_categories' => 'Setup Categories',
    'see_open_tournaments' => 'See Open Tournaments',
    'open_tournaments_in_your_country' => 'Open Tournaments in your country',
    'soon' => 'Soon',
    'configured_full' => 'configured',
    'see_all' => 'See all',
    'see_more' => 'See more',
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


    // Logs

    'object_type' => 'Object',
    'operation_type' => 'Operation',
    'object_id' => 'Object Id',
    'created_at' => 'Created',
    'updated_at' => 'Updated',
    'old_value' => 'Old Value',
    'new_value' => 'New Value',


    // Teams

    'team' => 'Team|Teams',
    'no_team_yet' => 'Still no team registered in this tournament',
    'add_new_team' => 'Add team',
    'registered_team' => 'Teams registered',

    // Federations
    'federation' => 'Federation|Federations',
    'federation.president' => 'President',
    'federation.vicepresident' => 'Vice President',
    'federation.secretary' => 'Secretary',
    'federation.treasurer' => 'Tesorary',
    'federation.admin' => 'Administrator',
    'federation.address' => 'Address',
    'federation.phone' => 'Phone',
    'federation.no_user_in_this_country' => 'No user registered in this country',
    'no_federation' => 'No federation ',

    // Associations
    'association' => 'Association|Associations',
    'association.president' => 'President',
    'association.address' => 'Address',
    'association.phone' => 'Phone',
    'association.no_user_in_this_country' => 'No user registered in this country',
    'association.add' => 'Add Association',
    'no_association_yet' => 'Still not any associations in this federation',
    'add_new_association' => 'Add a new association',
    'no_association' => 'No association ',

    // Clubs
    'club' => 'Club|Clubs',
    'club.president' => 'President',
    'club.address' => 'Address',
    'club.phone' => 'Phone',
    'club.no_user_in_this_country' => 'No user registered in this country',


    'where_do_you_practice' => '¿Where do you train?',
    'select_field' => 'Select an option',
    'no_association_available' => 'No associations in this federation',
    'no_club_available' => 'No clubs in this association',


    //Excel

    'import_excel' => 'Import data from Excel',
    'upload_file_to_csv_format' => 'File must be in .csv format.',
    'how_to_save_to_csv' => 'With Excel, you can save it with: File > Save as. Then, in  "File Format", select ".csv',
    'bulk_upload' => 'Invite competitors with an Excel file',
    'download_layout' => 'Layout File',

    // Trees
    'tree' => 'Tree|Trees',
    'no_generated_tree' => 'Still no tree generated in this championship',
    'document' => 'Document|Documents',
    'print' => 'Print',

    // Fights
    'fight' => 'Fight|Fights',
    'no_fight_list' => 'There is still no fight list for this championship',

    // Share

    'register_in_tournament' => 'Register in tournament',

];
