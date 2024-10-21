<?php
function cptui_register_my_cpts_exchange()
{
    /**
     * Post Type: Exchange.
     */

    $labels = [
        "name" => esc_html__("Exchange", "custom-post-type-ui"),
        "singular_name" => esc_html__("Exchange", "custom-post-type-ui")
    ];

    $args = [
        "label" => esc_html__("Exchange", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => ["slug" => "exchange", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail", "custom-fields"],
        "taxonomies" => ["exchange_category"],
        "show_in_graphql" => false
    ];

    register_post_type("exchange", $args);
}

add_action('init', 'cptui_register_my_cpts_exchange');

function cptui_register_my_taxes_exchange_category()
{
    /**
     * Taxonomy: Exchange Categories.
     */

    $labels = [
        "name" => esc_html__("Exchange Categories", "custom-post-type-ui"),
        "singular_name" => esc_html__(
            "Exchange Categories",
            "custom-post-type-ui"
        )
    ];

    $args = [
        "label" => esc_html__("Exchange Categories", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'exchange_category', 'with_front' => true],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "exchange_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false
    ];
    register_taxonomy("exchange_category", ["exchange"], $args);
}
add_action('init', 'cptui_register_my_taxes_exchange_category');

add_action(
    'acf/include_fields', function () {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group(
            array(
            'key' => 'group_61f94e6b696f3',
            'title' => 'Exchange Fields',
            'fields' => array(
            array(
                'key' => 'field_61f9502b449d7',
                'label' => 'Contact Name',
                'name' => 'exchange_contact_name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'First & Last Name',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f95134449d8',
                'label' => 'Organization',
                'name' => 'exchange_organization',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Organization Name',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f95152449d9',
                'label' => 'Contact Email',
                'name' => 'exchange_contact_email',
                'aria-label' => '',
                'type' => 'email',
                'instructions' => 'Email Address',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => ''
            ),
            array(
                'key' => 'field_61f95194449da',
                'label' => 'Member',
                'name' => 'exchange_member',
                'aria-label' => '',
                'type' => 'text',
                'instructions' =>
                    'Is the organization for the Exchange item a member?',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f951ec449db',
                'label' => 'Image',
                'name' => 'exchange_image',
                'aria-label' => '',
                'type' => 'image',
                'instructions' =>
                    'If you are not a member, add a logo for your organization',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => ''
            ),
            array(
                'key' => 'field_61f95200449dc',
                'label' => 'Item Status',
                'name' => 'exchange_item_status',
                'aria-label' => '',
                'type' => 'text',
                'instructions' =>
                    'New Exchange entry or an update to an existing entry?',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f95230449dd',
                'label' => 'Stage',
                'name' => 'exchange_stage',
                'aria-label' => '',
                'type' => 'text',
                'instructions' =>
                    'What is the development stage of your offering?',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f95256449de',
                'label' => 'Cost',
                'name' => 'exchange_cost',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Does your offering have a cost?',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f95272449df',
                'label' => 'License Type',
                'name' => 'exchange_license_type',
                'aria-label' => '',
                'type' => 'checkbox',
                'instructions' => 'What is the license type?',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'choices' => array(),
                'allow_custom' => 1,
                'save_custom' => 0,
                'default_value' => array(),
                'layout' => 'vertical',
                'toggle' => 0,
                'return_format' => 'value',
                'custom_choice_button_text' => 'Add new choice'
            ),
            array(
                'key' => 'field_61f952a7449e0',
                'label' => 'Offering Name',
                'name' => 'exchange_offering_name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Name of the offering',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f952b6449e1',
                'label' => 'Offering Description',
                'name' => 'exchange_offering_description',
                'aria-label' => '',
                'type' => 'textarea',
                'instructions' => 'Description of the offering',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 4,
                'new_lines' => ''
            ),
            array(
                'key' => 'field_61f952c8449e2',
                'label' => 'Links',
                'name' => 'exchange_links',
                'aria-label' => '',
                'type' => 'url',
                'instructions' =>
                    'Link title + link to the product on your website. You can enter more than one link.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => ''
            ),
            array(
                'key' => 'field_622bcdfb8e8d5',
                'label' => 'Product Image (HW)',
                'name' => 'exchange_product_image',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => ''
            ),
            array(
                'key' => 'field_61f95316e1465',
                'label' => 'Category',
                'name' => 'exchange_category',
                'aria-label' => '',
                'type' => 'taxonomy',
                'instructions' =>
                    'What category is this offering? Please only select a single category.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'taxonomy' => 'exchange_category',
                'field_type' => 'checkbox',
                'add_term' => 0,
                'save_terms' => 1,
                'load_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
                'allow_null' => 0,
                'bidirectional_target' => array()
            ),
            array(
                'key' => 'field_62e2e7ae9a99c',
                'label' => 'Processor Type',
                'name' => 'exchange_processor_type',
                'aria-label' => '',
                'type' => 'text',
                'instructions' =>
                    'Is there a specific processor type you want to specify?',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e804018a7',
                'label' => 'Hardware Type',
                'name' => 'exchange_hardware_type',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Hardware Type',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e821018a8',
                'label' => 'Memory (Single Board Computers)',
                'name' => 'exchange_memory_sbc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Memory (Single Board Computers)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e840018a9',
                'label' => 'FPGA (Single Board Computers)',
                'name' => 'exchange_fpga_sbc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'FPGA (Single Board Computers)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e854018aa',
                'label' => 'Storage (Single Board Computers)',
                'name' => 'exchange_storage_sbc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Storage (Single Board Computers)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e869018ab',
                'label' => 'Video Output (Single Board Computers)',
                'name' => 'exchange_video_output_sbc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Video Output (Single Board Computers)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e8f4018ac',
                'label' => 'I/O (Single Board Computers)',
                'name' => 'exchange_io_sbc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'I/O (Single Board Computers)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e914018ad',
                'label' => 'Board Type (Controller Boards)',
                'name' => 'exchange_board_type_cb',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Board Type (Controller Boards)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e987018ae',
                'label' => 'Bus Type (Controller Boards)',
                'name' => 'exchange_bus_type_cb',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Bus Type (Controller Boards)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e9b6018af',
                'label' => 'Compute Type (Edge Computers)',
                'name' => 'exchange_compute_type_ec',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Compute Type (Edge Computers)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e9ca018b0',
                'label' => 'Node Count (Data Center/Cloud)',
                'name' => 'exchange_node_count_dcc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Node Count (Data Center/Cloud)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e9e2018b1',
                'label' => 'Node Memory (Data Center/Cloud)',
                'name' => 'exchange_node_memory_dcc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Node Memory (Data Center/Cloud)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2e9fa018b2',
                'label' => 'Storage Type (Data Center/Cloud)',
                'name' => 'exchange_storage_type_dcc',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Storage Type (Data Center/Cloud)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2ea38018b3',
                'label' => 'Memory (Laptop/Desktop)',
                'name' => 'exchange_memory_ld',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Memory (Laptop/Desktop)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2ea49018b4',
                'label' => 'Core Count (Laptop/Desktop)',
                'name' => 'exchange_core_count_ld',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Core Count (Laptop/Desktop)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2ea60018b5',
                'label' => 'Storage Size (Laptop/Desktop)',
                'name' => 'exchange_storage_size_ld',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Storage Size (Laptop/Desktop)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2eb2d018b6',
                'label' => 'Type (Devices)',
                'name' => 'exchange_type_devices',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Type (Devices)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2eb73018b7',
                'label' => 'Core Type',
                'name' => 'exchange_core_type',
                'aria-label' => '',
                'type' => 'checkbox',
                'instructions' => 'Core Type',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'choices' => array(),
                'allow_custom' => 1,
                'save_custom' => 0,
                'default_value' => array(),
                'layout' => 'vertical',
                'toggle' => 0,
                'return_format' => 'value',
                'custom_choice_button_text' => 'Add new choice'
            ),
            array(
                'key' => 'field_62e2ec07018b8',
                'label' => 'RISC-V Base',
                'name' => 'exchange_riscv_base',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'RISC-V Base',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_622bce8d8e8d8',
                'label' => 'User Spec',
                'name' => 'exchange_user_spec',
                'aria-label' => '',
                'type' => 'checkbox',
                'instructions' => 'What user spec is this',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'choices' => array(),
                'allow_custom' => 1,
                'save_custom' => 0,
                'default_value' => array(),
                'layout' => 'vertical',
                'toggle' => 0,
                'return_format' => 'value',
                'custom_choice_button_text' => 'Add new choice'
            ),
            array(
                'key' => 'field_62e2ec41018b9',
                'label' => 'Notable Extensions',
                'name' => 'exchange_notable_extensions',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Notable Extensions',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_62e2ec59018ba',
                'label' => 'App Core Count',
                'name' => 'exchange_app_core_count',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'App Core Count',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f95780fdbe0',
                'label' => 'Software Type',
                'name' => 'exchange_software_type',
                'aria-label' => '',
                'type' => 'checkbox',
                'instructions' => 'Software Type: Select all that apply',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'choices' => array(),
                'allow_custom' => 1,
                'save_custom' => 0,
                'default_value' => array(),
                'layout' => 'vertical',
                'toggle' => 0,
                'return_format' => 'value',
                'custom_choice_button_text' => 'Add new choice'
            ),
            array(
                'key' => 'field_61f957b7fdbe1',
                'label' => 'Service Type',
                'name' => 'exchange_service_type',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Service Type: select all that apply',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_620a85d58adbf',
                'label' => 'Learn Level',
                'name' => 'exchange_learn_level',
                'aria-label' => '',
                'type' => 'number',
                'instructions' => 'What learn level is this offering',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => ''
            ),
            array(
                'key' => 'field_61f957defdbe3',
                'label' => 'Learn Type',
                'name' => 'exchange_learn_type',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Learn Type: select all that apply',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_61f957f2fdbe4',
                'label' => 'Learn Category',
                'name' => 'exchange_learn_category',
                'aria-label' => '',
                'type' => 'text',
                'instructions' =>
                    'What categories does your offering focus on: select all that apply',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_622bce5f8e8d6',
                'label' => 'Learn Language',
                'name' => 'exchange_learn_language',
                'aria-label' => '',
                'type' => 'checkbox',
                'instructions' => 'What learn language is this',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'choices' => array(),
                'allow_custom' => 1,
                'save_custom' => 0,
                'default_value' => array(),
                'layout' => 'vertical',
                'toggle' => 0,
                'return_format' => 'value',
                'custom_choice_button_text' => 'Add new choice'
            ),
            array(
                'key' => 'field_62004c02740f5',
                'label' => 'Sort Order',
                'name' => 'exchange_sort',
                'aria-label' => '',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => ''
            )
            ),
            'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'exchange'
                )
            )
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 1
            )
        );
    }
);

/*********************************************************/
/* ADD IN SEARCH AND FILTER TEMPLATE FROM SUB DIRECTORY */
/*******************************************************/

function get_new_archive_template($archive_template)
{
    global $post;
    //$archive_template = get_stylesheet_directory() . '/page-templates/archive.php';
    return $archive_template;
}
add_filter("archive_template", "get_new_archive_template");

/* SEARCH AND FILTER RESULTS FORM */
function filter_input_object($input_object, $sfid)
{
    if ($input_object["name"] == "_sf_search")
    {
        $input_object["attributes"]["id"] = "sf-search-box";
    }

    if ($input_object["name"] == "_sft_exchange_category")
    {
        $input_object["attributes"]["class"] = "sf-categories";
    }

    return $input_object;
}
add_filter("sf_input_object_pre", "filter_input_object", 10, 2);

/* SEARCH AND FILTER MIMIC */
function top_Search_Filter()
{
    return '
	<input placeholder="Search Exchange…" class="top-search-box" id="sf-top-search-box" type="text" value="" >
	<input class="top-search-btn" type="submit" value="&#xf002;">
	
	<div class="sf-top-categories">
	<input type="checkbox" value="top-board"><label>Hardware</label>
	<input type="checkbox" value="top-core"><label>Cores</label>
	<input type="checkbox" value="top-software"><label>Software</label>
	<input type="checkbox" value="top-services"><label>Services</label>
	<input type="checkbox" value="top-learning"><label>Learning</label>	
	
	</div>
	';
}
add_shortcode("topsearchandfilter", "top_Search_Filter");

add_action("wp_enqueue_scripts", "remove_sf_scripts", 100);
function remove_sf_scripts()
{
    if (is_post_type_archive("tribe_events"))
    {
        wp_deregister_script("jquery-ui-datepicker");
        wp_deregister_script("search-filter-plugin-build");
        wp_deregister_script("search-filter-chosen-script");
    }
}