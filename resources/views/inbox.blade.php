<?php 
    // $email = Auth::user()->email;
    // $password = Auth::user()->password;
    
    $email = env('OUTLOOK_USERNAME');
    $password = env('OUTLOOK_PASSWORD');

    // Opens the mailbox with the info in the function
    $mailbox = new PhpImap\Mailbox(
        // '{imap.gmail.com:993/imap/ssl}INBOX', // IMAP server and mailbox folder
        '{outlook.office365.com:993/imap/ssl}',
        $email,
        $password,
        __DIR__,
        'US-ASCII'
    );

    try {
        // Search in mailbox folder for specific emails
        // Here, we search for "all" emails
        $mails_ids = $mailbox->searchMailbox('ALL');
    } catch(PhpImap\Exceptions\ConnectionException $ex) {
        // Shows an the error message
        // echo "Oops something went wrong." . $ex;
        ?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body class="error-body">
    <div id="app">
        <div class="py-2"></div>
        <div class="row justify-content-center">
            <div class="col-sm-3">
                <div class="card error-card-body">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                {{ __('Error') }}
                            </div>
                            <div class="col-md-2 user-header-right">
                                <a href="{{ url('/home') }}">
                                    <i class='icon icon-edit'>
                                        <x-gmdi-close style="height: 20px;" />
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        Oops something went wrong. <br>
                        Did you fill in the right credentials?
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
        // header( "Location: home" );
        // header('Refresh: 3; URL=home');
        die();
    }

    // Change default path delimiter '.' to '/'
    $mailbox->setPathDelimiter('/');

    // Switch server encoding
    $mailbox->setServerEncoding('UTF-8');

    // Change attachments directory
    $mailbox->setAttachmentsIgnore(true);
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card top-nav-card">
                    <div class="card-body">
                        <a class="top-nav-card-a-hover" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                        <a class="top-nav-card-a-normal">{{ __(' / Extra Pages / ') }}</a>
                        <a class="top-nav-card-a-bold" href="{{ url('/inbox') }}">{{ __('My Inbox') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-all-tasks">{{ __('Your Inbox') }}
                    <a href="mailto:" style="float: right">
                        <button class="btn btn-compose-email btn-primary">Compose email</button>
                    </a>
                </div>
                <div class="card-body card-body-all-tasks">
                    <div class="panel-body" style="height: 21rem; overflow:auto;">
                        <table class="table task-table card-table-all-tasks">
                            <thead>
                                <th>Title</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach($mails_ids as $mail_id) {
                                    
                                    $email = $mailbox->getMail(
                                        $mail_id, // ID of the email, you want to get
                                        false // Do NOT mark emails as seen
                                    );
                                    ?>
                                <tr>
                                    <td class="table-text">
                                        <div style="width: 200px;"><?php echo 'from-name: ' . isset($email->fromName) ? $email->fromName : $email->fromAddress . '<br>'; ?></div>
                                    </td>
                                    <td class="table-text">
                                        <div style="width: 200px;">
                                            <a href="mailto:<?php echo $email->fromAddress; ?>">
                                                <?php echo $email->fromAddress; ?>
                                        </div>
                                        </a>
                    </div>
                    </td>
                    <td class="table-text">
                        <div style="width: 225px;"><?php echo $email->subject; ?></div>
                    </td>
                    <td class="table-text">
                        <div style="width: 525px;"><?php
if (!empty($email->getAttachments())) {
    echo count($email->getAttachments()) . ' attachements';
}
if ($email->textHtml) {
    // echo $email->textHtml;
    echo $email->textPlain;
} else {
    echo $email->textPlain;
} ?></div>
                    </td>
                    </tr>
                    <?php
                                }
                            ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    // Disconnect from mailbox
    $mailbox->disconnect();
    ?>
@endsection
