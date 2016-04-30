<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Mailer Configuration
$config['mail_mailer']          = 'PHPMailer';
$config['mail_debug']           = 0; // default: 0, debugging: 2, 'local'
$config['mail_debug_output']    = 'html';
$config['mail_smtp_auth']       = true;
$config['mail_smtp_secure']     = 'tls'; // default: '' | tls | ssl |
$config['mail_charset']         = 'utf-8';

// Templates Path and optional config
$config['mail_template_folder'] = 'templates/email';
$config['mail_template_options'] = array(
                                       'SITE_NAME' => 'Retreat Centre Sukamakmur',
                                       'SITE_LOGO' => 'http://rcsukamakmur-dwipaulina.rhcloud.com/images/logo.jpg',
                                       'BASE_URL'  => 'http://rcsukamakmur-dwipaulina.rhcloud.com',
                                    );
// Server Configuration
$config['mail_smtp']            = 'smtp-mail.outlook.com';
$config['mail_port']            = 587; // for gmail default 587 with tls
$config['mail_user']            = 'someone@outlook.com';
$config['mail_pass']            = '';

// Mailer config Sender/Receiver Addresses
$config['mail_admin_mail']      = 'dwipaulina@windowslive.com';
$config['mail_admin_name']      = 'Web Master';

$config['mail_from_mail']       = 'dwipaulina@windowslive.com';
$config['mail_from_name']       = 'RC Sukamakmur';

$config['mail_replyto_mail']    = 'dwipaulina@windowslive.com';
$config['mail_replyto_name']    = 'Dwi Paulina';

// BCC and CC Email Addresses
$config['mail_bcc']             = 'dwipaulina@windowslive.com';
$config['mail_cc']              = 'dwipaulina@windowslive.com';

// BCC and CC enable config, default disabled;
$config['mail_setBcc']          = false;
$config['mail_setCc']           = false;


/* End of file mail_config.php */
/* Location: ./application/config/mail_config.php */
