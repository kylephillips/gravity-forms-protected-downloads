<div class="gfpd-modal-overlay" data-gfpd-download-modal>
	<div class="gfpd-modal-content" data-gfpd-download-modal>
		<div class="gfpd-modal-content-interior">
			<div class="gfpd-modal-header">
				<h3><?php _e('Add a Protected Download', 'gfpd'); ?></h3>
			</div>
			<div class="gfpd-modal-body">
				<p>
					<label for="gfpd_button_text"><?php _e('Button Text', 'gfpd'); ?></label>
					<input type="text" id="gfpd_button_text" value="<?php _e('Download', 'gfpd'); ?>" data-gfpd-button-text />
				</p>
				<p>
					<label for="gfpd_download_classes"><?php _e('Button CSS Classes', 'gfpd'); ?></label>
					<input type="text" id="gfpd_download_css" value="<?php _e('btn download-btn', 'gfpd'); ?>" data-gfpd-css />
				</p>
				<p>
					<label for="gfpd_download_modal_title"><?php _e('Modal Title', 'gfpd'); ?></label>
					<input type="text" id="gfpd_download_modal_title" value="<?php _e('Download', 'gfpd'); ?>" data-gfpd-modal-title />
				</p>
				<label><?php _e('Download', 'gfpd'); ?></label>
				<input type="hidden" id="gfpd_download_id" value="" data-gfpd-download-id>
				<div class="gfpd-error" data-gfpd-download-list-error style="display:none;"></div>
				<div class="gfpd-download-post-list loading" data-gfpd-download-list>
					<ul>
						<?php 
							for ( $i = 1; $i < 20; $i++ ) { 
								// echo '<li><a href="#" data-gfpd-download-post="' . $i . '">Post ' . $i . ' Lorem Ipsum</a></li>';
							}
						?>
					</ul>
				</div><!-- .gfpd-download-post-list -->
			</div>
			<div class="gfpd-modal-footer">
				<button data-gfpd-insert-download class="button button-primary">Insert</button>
				<button data-gfpd-close-modal class="button" data-gfpd-close-modal>Cancel</button>
			</div><!-- .gfpd-modal-footer -->
		</div><!-- .gfpd-modal-content-interior -->
	</div><!-- .gfpd-modal-content -->
</div><!-- .gfpd-modal-overlay -->