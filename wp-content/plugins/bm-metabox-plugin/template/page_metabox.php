<?php
    $post_id = isset($post->ID) ? $post->ID : "";
    $title = get_post_meta($post_id, 'bmmb_meta_title', true);
    $description = get_post_meta($post_id, 'bmmb_meta_description', true);
?>

<p>
    <label for="bmmb_meta_title">Meta Title</label>
    <input type="text" 
            placeholder="Meta Titel..." 
            id="bmmb_meta_title" 
            name="bmmb_meta_title"
            value="<?php echo $title; ?>"
        >
</p>

<p>
    <label for="bmmb_meta_description">Meta Description</label>
    <input type="text" 
            placeholder="Meta Description..." 
            id="bmmb_meta_description" 
            name="bmmb_meta_description"
            value="<?php echo $description; ?>"
            >
</p>