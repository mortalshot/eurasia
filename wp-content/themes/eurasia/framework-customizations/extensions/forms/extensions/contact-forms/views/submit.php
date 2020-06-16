<?php if (!defined('FW')) {
	die('Forbidden');
}
/**
 * @var int $form_id
 * @var string $submit_button_text
 * @var array $extra_data
 */
?>
<div class="conctact-policy">Отправляя заявку, я даю согласие на обработку персональных данных и соглашаюсь c условиями <a href="http://inotaryoffice.ru/privacy/">политики конфиденциальности</a>.</div>
<div class="form-footer">
	<input class="btn btn_medium" type="submit" value="<?php echo esc_attr($submit_button_text) ?>" />
</div>