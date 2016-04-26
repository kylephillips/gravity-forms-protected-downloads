<div class="gfpd-modal-overlay" data-gfpd-download-modal>
	<div class="gfpd-modal-content" data-gfpd-download-modal>
		<div class="gfpd-modal-content-interior">
			<div class="gfpd-modal-header">
				<h3><?php echo apply_filters('gfpd_media_button_modal_text', __('Add a Protected Download', 'gfpd')); ?>
				</h3>
			</div>
			<div class="gfpd-modal-body">
				<div class="field-row">
					<div class="field">
						<label for="gfpd_button_text"><?php _e('Button Text', 'gfpd'); ?></label>
						<input type="text" id="gfpd_button_text" value="<?php _e('Download', 'gfpd'); ?>" data-gfpd-button-text />
					</div>
					<div class="field right">
						<label for="gfpd_download_classes"><?php _e('Button CSS Classes', 'gfpd'); ?></label>
						<input type="text" id="gfpd_download_css" value="<?php _e('btn download-btn', 'gfpd'); ?>" data-gfpd-css />
					</div>
				</div>
				<div class="field-row bordered">
					<div class="field full">
						<label for="gfpd_download_modal_title"><?php _e('Modal Title', 'gfpd'); ?></label>
						<input type="text" id="gfpd_download_modal_title" value="<?php _e('Download', 'gfpd'); ?>" data-gfpd-modal-title />
					</div>
				</div>
				<div class="field-row bordered">
					<label><?php _e('Download', 'gfpd'); ?></label>
					<input type="hidden" id="gfpd_download_id" value="" data-gfpd-download-id>
					<div class="gfpd-error" data-gfpd-download-list-error style="display:none;"></div>
					<div class="gfpd-modal-list loading" data-gfpd-download-list>
						<ul></ul>
					</div><!-- .gfpd-download-post-list -->
				</div>
				<div class="field-row bordered">
					<div class="field">
						<label><?php _e('Form', 'gfpd'); ?></label>
						<input type="hidden" id="gfpd_form_id" value="" data-gfpd-form-id>
						<div class="gfpd-error" data-gfpd-form-list-error style="display:none;"></div>
						<div class="gfpd-modal-list loading" data-gfpd-form-list>
							<ul></ul>
						</div>
					</div>
					<div class="field right">
						<label><?php _e('Download Field', 'gfpd'); ?></label>
						<input type="hidden" id="gfpd_field_id" value="" data-gfpd-field-id>
						<div class="gfpd-error" data-gfpd-field-list-error style="display:none;"></div>
						<div class="gfpd-modal-list" data-gfpd-field-list>
							<ul></ul>
						</div>
					</div>
				</div>
			</div><!-- .gfpd-modal-body -->
			<div class="gfpd-modal-footer">
				<a href="<?php echo esc_url( admin_url('post-new.php?post_type=download') );?>" class="button button-left"><?php _e('Add New', 'gfpd'); ?></a>
				<button data-gfpd-insert-download class="button button-primary"><?php _e('Insert', 'gfpd'); ?></button>
				<button data-gfpd-close-modal class="button" data-gfpd-close-modal><?php _e('Cancel', 'gfpd'); ?></button>
			</div><!-- .gfpd-modal-footer -->
		</div><!-- .gfpd-modal-content-interior -->
	</div><!-- .gfpd-modal-content -->
</div><!-- .gfpd-modal-overlay -->