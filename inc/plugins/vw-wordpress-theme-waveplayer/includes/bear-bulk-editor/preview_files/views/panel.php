<div id="preview_files_popup_editor" style="display: none;">
	<div class="woobe-modal woobe-modal2 woobe-style" style="z-index: 15002; width: 80%;">
		<div class="woobe-modal-inner">
			<div class="woobe-modal-inner-header">
				<h3 class="woobe-modal-title">&nbsp;</h3>
				<a href="javascript:void(0)" class="woobe-modal-close woobe-modal-close-preview-files"></a>
			</div>
			<div class="woobe-modal-inner-content">
				<div class="woobe-form-element-container">
					<div id="woobe-modal-content-popupeditor">
						<div class="woobe-form-element-container" style="padding: 0;">
							<a href="#" class="woobe-button woobe_insert_preview_file" data-place="top"><?php echo esc_html__( 'Add an audio preview file', 'vwwaveplayer'); ?></a><br />
							<br />
							<div id="woobe_preview_files_bulk_operations">
								<div class="col-lg-12">

									<select id="woobe_preview_files_operations">
										<option value="new"><?php esc_html_e( 'Replace all preview files with the selected ones', 'vwwaveplayer' ); ?></option>
										<option value="add"><?php esc_html_e( 'Add the selected preview files to the existing ones', 'vwwaveplayer' ); ?></option>
										<option value="delete"><?php esc_html_e( 'Remove the selected preview files from the products', 'vwwaveplayer' ); ?></option>
										<option value="delete_forever"><?php esc_html_e( 'Remove the selected preview files from the products and delete the corresponding audio files from the media library', 'vwwaveplayer' ); ?></option>
									</select>


								</div>

								<div class="clear"></div>
							</div>


							<form method="post" action="" id="products_preview_files_form">
								<ul class="woobe_fields_tmp"></ul>
							</form>

						</div>
					</div>
				</div>
			</div>
			<div class="woobe-modal-inner-footer">
				<a href="javascript:void(0)" class="woobe-modal-close-preview-files button button-primary button-large button-large-2"><?php echo esc_html__( 'Cancel', 'vwwaveplayer' ) ?></a>
				<a href="javascript:void(0)" class="woobe-modal-save-preview-files button button-primary button-large button-large-1"><?php echo esc_html__( 'Apply', 'vwwaveplayer' ) ?></a>
			</div>
		</div>
	</div>

	<div class="woobe-modal-backdrop" style="z-index: 15001;"></div>

</div>

<template id="woobe_preview_file_li_tpl">
	<li>
		<img src="" alt="" class="woobe_gal_img_block" />
		<a href="#" class="woobe_preview_file_delete"><span class="icon-trash button"></span></a>
		<span class="woobe_preview_file_name"></span>
		<input type="hidden" name="woobe_preview_files[]" value="" />
	</li>
</template>
