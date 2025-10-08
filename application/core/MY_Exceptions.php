<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions
{
    protected function render_custom_500($heading, $message, $status_code = 500)
    {
        if (is_cli()) {
            return parent::show_error($heading, $message, $status_code);
        }

        if (!headers_sent()) {
            set_status_header($status_code);
        }

        $templates_path = config_item('error_views_path');
        if (empty($templates_path)) {
            $templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
        }

        $template = $templates_path.'html'.DIRECTORY_SEPARATOR.'error_500.php';
        if (!is_file($template)) {
            $template = $templates_path.'html'.DIRECTORY_SEPARATOR.'error_general.php';
        }

        $error_heading = $heading ?: 'Terjadi Kesalahan';
        if (is_array($message)) {
            $message = implode(' ', $message);
        }
        $error_message = $message ?: 'Maaf, kami tidak dapat menampilkan halaman ini saat ini. Silakan coba lagi nanti.';
        $error_identifier = $this->generate_error_id();

        // Backwards compatibility variables used by default views
        $heading = $error_heading;
        $message = '<p>'.$error_message.'</p>';
        $error_id = $error_identifier;

        ob_start();
        include $template;
        $buffer = ob_get_clean();
        echo $buffer;
        exit(1);
    }

    protected function generate_error_id()
    {
        try {
            return strtoupper(bin2hex(random_bytes(4)));
        } catch (Throwable $th) {
            return strtoupper(uniqid());
        }
    }

    public function show_exception($exception)
    {
        if (ENVIRONMENT === 'development' || is_cli()) {
            return parent::show_exception($exception);
        }

        log_message('error', 'Unhandled Exception: '.$exception->getMessage().'\n'.$exception->getTraceAsString());
        return $this->render_custom_500('Terjadi Kesalahan', 'Maaf, kami mengalami kendala teknis. Tim kami sudah menerima laporan ini.');
    }

    public function show_error($heading, $message, $status_code = 500, $template = 'error_general')
    {
        if (ENVIRONMENT === 'development' || is_cli() || $status_code < 500) {
            return parent::show_error($heading, $message, $status_code, $template);
        }

        log_message('error', 'Application Error ('.$status_code.'): '.strip_tags(is_array($message) ? implode(' ', $message) : $message));
        return $this->render_custom_500($heading, $message, $status_code);
    }

    public function show_php_error($severity, $message, $filepath, $line)
    {
        if (ENVIRONMENT === 'development' || is_cli()) {
            return parent::show_php_error($severity, $message, $filepath, $line);
        }

        $logMessage = sprintf('PHP Error [%s]: %s in %s on line %d', $severity, $message, $filepath, $line);
        log_message('error', $logMessage);
        return $this->render_custom_500('Terjadi Kesalahan', 'Terjadi kendala pada sistem kami. Tim teknis telah menerima notifikasi dan akan segera menanganinya.');
    }
}
