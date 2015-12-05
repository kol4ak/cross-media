<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php foreach ($fields as $id => $field): ?>
    <?php if (!empty($field->separator)): ?>
        <?php print $field->separator; ?>
    <?php endif; ?>


    <?php //echo $id.'<br />';

    if($id == 'title'){$title = $field->content;}
    if($id == 'field_image'){$img = $field->content;}
    if($id == 'field_hot'){$News_hot = $field->content;}
    if($id == 'created') {$Created = $field->content; }
    if($id == 'field_author') {$Author = $field->content; }
    if($id == 'totalcount') {$Count = $field->content; }
    if($id == 'comment_count') {$CommentCount = $field->content; }


    ?>


    <?php //print $field->wrapper_prefix; ?>
    <?php //print $field->label_html; ?>
    <?php //print $field->content; ?>
    <?php //print $field->wrapper_suffix; ?>
<?php endforeach; ?>

<div class="views-field-field-image">
    <?php

    if(isset($img))
    {
        print $img; } ;

    ?>

</div>

<div class="views-field-field-title">
    <?php
        if(isset($News_hot)){
    print '<div class="hot">'.$title.'</div>';

    }else{print $title;}
   ?>
</div>

<div class="views-field-field-info">
   <div class="views-field-field-created">
         <?php
         print $Created;
         ?>
     </div>


   <!--  <div class="views-field-field-author">
        <?php
        print $Author;
        ?>
    </div> -->
</div>

    <div class="views-field-field-count">
        <img src="http://cross-media.org.ua/sites/default/files/commcount.png">
        <?php
        print $CommentCount;
        ?>
    </div>

    <div class="views-field-field-count">
        <img src="http://cross-media.org.ua/sites/default/files/count.png">
        <?php
        print $Count;
        ?>
    </div>


<?php //print $field->wrapper_prefix; ?>
<?php //print $field->label_html; ?>

<?php //print $field->wrapper_suffix; ?>
