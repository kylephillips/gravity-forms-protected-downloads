<?php wp_nonce_field( 'my_gfpd_meta_box_nonce', 'gfpd_meta_box_nonce' ); ?>
<div class="gfpd-hidden">
	<input type="hidden" name="gfpd_download" id="gfpd_download" value="<?php echo $this->meta['download']; ?>">
</div>

<div class="gfpd-file-meta<?php if ( $this->meta['download'] ) echo ' has-attachment'; ?>">
	<div class="icon">
		<img data-name="icon" src="<?php echo \GFormProtected\Helpers::site_url(); ?>/wp-includes/images/media/document.png" alt="<?php _e('File Icon', 'gfpd'); ?>">
	</div><!-- .icon -->
	<div class="meta-content">
		<?php if ( $this->meta['download'] ) : ?>
			<p class="download-meta">
				<strong><?php echo $this->download_meta['title']; ?></strong><br>
				<strong>File Name:</strong> <a href="<?php echo $this->download_meta['link']; ?>" target="_blank"><?php echo $this->download_meta['file'] . '.' . $this->download_meta['ext']; ?></a><br>
			</p>
		<?php else : ?>
			<p class="download-meta no-attachment">
				<strong data-download-title></strong><br>
				<strong>File Name:</strong> <a href="" data-download-link target="_blank"><span data-download-filename></span></a>
			</p>
		<?php endif; ?>
		<p class="no-file-selected">No File Selected</p>
		<button class="button <?php if ( $this->meta['download'] ) echo 'has-attachment'; ?>" data-gfpd-open-media-library><?php _e('Choose File', 'gfpd'); ?></button>
		<a href="#" data-gfpd-remove-attachment class="remove-attachment">&times;</a>
	</div><!-- .meta-content -->
</div><!-- gfpd-file-meta -->