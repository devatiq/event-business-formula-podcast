<?php 
namespace EBFP\Backend\Inc;

class UserProfile {

    public function __construct() {
        // Hook into user profile actions
        add_action('show_user_profile', [$this, 'add_social_profile_fields']);
        add_action('edit_user_profile', [$this, 'add_social_profile_fields']);
        add_action('personal_options_update', [$this, 'save_social_profile_fields']);
        add_action('edit_user_profile_update', [$this, 'save_social_profile_fields']);
    }

    /**
     * Add custom social profile fields to the user profile
     *
     * @param \WP_User $user Current user object
     */
    public function add_social_profile_fields($user) {
        ?>
        <h3><?php _e('Social Profiles', 'event-business-formula'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="facebook"><?php _e('Facebook URL', 'event-business-formula'); ?></label></th>
                <td>
                    <input type="url" name="facebook" id="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>" class="regular-text" />
                    <p class="description"><?php _e('Add your Facebook profile URL.', 'event-business-formula'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="x"><?php _e('X (Twitter) URL', 'event-business-formula'); ?></label></th>
                <td>
                    <input type="url" name="x" id="x" value="<?php echo esc_attr(get_the_author_meta('x', $user->ID)); ?>" class="regular-text" />
                    <p class="description"><?php _e('Add your X (Twitter) profile URL.', 'event-business-formula'); ?></p>
                </td>
            </tr>
        </table>
        <?php
        // Add a nonce for security
        wp_nonce_field('save_social_profile_fields', 'social_profile_fields_nonce');
    }

    /**
     * Save the custom social profile fields
     *
     * @param int $user_id The user ID
     * @return void
     */
    public function save_social_profile_fields($user_id) {
        // Check if the user has permission to edit
        if (!current_user_can('edit_user', $user_id)) {
            return;
        }

        // Verify the nonce
        if (!isset($_POST['social_profile_fields_nonce']) || !wp_verify_nonce($_POST['social_profile_fields_nonce'], 'save_social_profile_fields')) {
            return;
        }

        // Sanitize and save the fields
        if (isset($_POST['facebook'])) {
            update_user_meta($user_id, 'facebook', sanitize_text_field($_POST['facebook']));
        }

        if (isset($_POST['x'])) {
            update_user_meta($user_id, 'x', sanitize_text_field($_POST['x']));
        }
    }
}