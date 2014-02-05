<?php
		if($_POST['cli_hidden'] == 'Y') {
			//Form data sent
			

			$cli_icon_size = $_POST['cli_icon_size'];
			update_option('cli_icon_size', $cli_icon_size);
		
			

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p>
            </div>

			<?php
		} else {
			//Normal page display
			$cli_icon_size = get_option( 'cli_icon_size' );

		}

?>


<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__('Category List Icon Settings')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="cli_hidden" value="Y">
        <?php settings_fields( 'cli_plugin_options' );
				do_settings_sections( 'cli_plugin_options' );
			
		?>

<table class="form-table">
               
	<tr valign="top">
		<th scope="row">Icon Size</th>
		<td style="vertical-align:middle;">                     
                     <input type="text" name="cli_icon_size" id="cli-icon-size"  value ="<?php if ( isset( $cli_icon_size ) ) echo $cli_icon_size; ?>">px
		</td>
	</tr>
















</table>
                <p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>
		</form>

   
</div>
