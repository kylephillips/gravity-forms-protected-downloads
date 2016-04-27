<?php
$active_forms = $this->settings_repo->getActiveForms();
?>
<div class="wrap">
	<h1><?php _e('Gravity Forms Protected Downloads Settings', 'wpsimplelocator'); ?></h1>
	<?php if ( $this->forms ) : ?>
		<div class="gfpd-form-settings">
			<form method="post" enctype="multipart/form-data" action="options.php">
				<?php settings_fields( 'gfpd-general' ); ?>
				<ul>
				<?php 
					foreach ( $this->forms as $key => $form ) :
						$out = '<li>';
						$out .= '<label><input type="checkbox" name="gfpd_forms[' . $form['id'] . '][form]" value="' . $form['id'] . '" data-gfpd-form-checkbox';
						if ( in_array($form['id'], $active_forms) ) $out .= ' checked';
						$out .= ' />' . $form['title'] . '</label>';
						
						$out .= '<div class="fields';
						if ( in_array($form['id'], $active_forms) ) $out .= ' visible';
						$out .= '">';
						$out .= '<p><strong>' . __('Select the field to store the Download Title.', 'gfpd') . '</strong></p>';
						$out .= '<ul>';
						$active_field = $this->settings_repo->getActiveField($form['id']);
						foreach ( $form['fields'] as $field ) :
							if ( !$field['label'] ) continue;
							$out .= '<li>';
							$out .= '<label><input type="radio" name="gfpd_forms[' . $form['id'] . '][field]" value="' . $field['id'] . '"';
							if ( $field['id'] == $active_field ) $out .= ' checked';
							$out .= ' />';
							$out .= $field['label'] . '</label>';
							$out .= '</li>';
						endforeach;
						$out .= '</ul>';
						$out .= '</div>';

						$out .= '</li>';
						echo $out;
					endforeach;
				?>
				</ul>
				<?php submit_button(); ?>
			</form>
		</div><!-- .gfpd-form-settings -->
		
	<?php else : ?>
		<p><?php _e('It looks like you don\'t have any forms yet.', 'gfpd'); ?></p>
	<?php endif; ?>
	<p class="gfpd-plugin-version"><?php _e('Gravity Forms Protected Download Version', 'gfpd'); echo ' ' . get_option('gfpd_version'); ?></p>
</div>