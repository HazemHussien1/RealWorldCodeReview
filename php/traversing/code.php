
public function clear(): void {

    if (isset($this->request->get['filename'])) {
        $filename = (string)$this->request->get['filename'];
    } else {
        $filename = '';
    }

    $json = [];

    if (!$this->user->hasPermission('modify', 'tool/log')) {
        $json['error'] = $this->language->get('error_permission');
    }

    // DIR_LOGS = /system/storage/logs/
    $file = DIR_LOGS . $filename;

    if (!is_file($file)) {
        $json['error'] = sprintf($this->language->get('error_file'), $filename);
    }

    if (!$json) {
        $handle = fopen($file, 'w+');
        fclose($handle);
        $json['success'] = $this->language->get('text_success');
    }
}
