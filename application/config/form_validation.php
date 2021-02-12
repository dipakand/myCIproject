<?php
$config = array(
    'login' => array(
        array(
            'field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|alpha'
        ),
        array(
            'field' => 'password', 'label' => 'Password', 'rules' => 'required|trim'
        )
    ),
    'edit_company' => array(
        array(
            'field' => 'company_name', 'label' => 'Company Name', 'rules' => 'required'
        ),
        array(
            'field' => 'industry_type', 'label' => 'Industry Type', 'rules' => 'required|alpha'
        ),
        array(
            'field' => 'website', 'label' => 'Website', 'rules' => 'required|trim'
        ),
        array(
            'field' => 'company_city', 'label' => 'Company City', 'rules' => 'required|alpha'
        ),
        array(
            'field' => 'state', 'label' => 'State', 'rules' => 'required'
        ),
        array(
            'field' => 'postal_code', 'label' => 'Postal Code', 'rules' => 'required|numeric|min_length[6]|max_length[6]'
        ),
        array(
            'field' => 'company_phone', 'label' => 'Company Phone', 'rules' => 'required|numeric'
        ),
        array(
            'field' => 'company_gst', 'label' => 'Company Gst', 'rules' => ''
        ),
        array(
            'field' => 'company_address', 'label' => 'Company Address', 'rules' => ''
        )
    ),
    'sale_exe' => array(
        array(
            'field' => 'name', 'label' => 'Name', 'rules' => 'required'
        ),
        array(
            'field' => 'contact', 'label' => 'Contact', 'rules' => 'required|numeric|min_length[10]|max_length[10]'
        ),
        array(
            'field' => 'email', 'label' => 'Email', 'rules' => 'valid_email|required'
        ),
        array(
            'field' => 'password', 'label' => 'Password', 'rules' => 'required'
        )
    ),
    'product_add' => array(
        array(
            'field' => 'brand', 'label' => 'Brand', 'rules' => 'required'
        ),
        array(
            'field' => 'name', 'label' => 'Product Name', 'rules' => 'required|alpha'
        ),
        array(
            'field' => 'category', 'label' => 'Category', 'rules' => 'required'
        ),
        array(
            'field' => 'hsn', 'label' => 'HSN', 'rules' => 'required|numeric'
        ),
        array(
            'field' => 'i_gst', 'label' => 'I GST', 'rules' => 'required|numeric|min_length[1]|max_length[2]'
        )
    ),
    'product_edit' => array(
        array(
            'field' => 'brand', 'label' => 'Brand', 'rules' => 'required'
        ),
        array(
            'field' => 'name', 'label' => 'Product Name', 'rules' => 'required'
        ),
        array(
            'field' => 'category', 'label' => 'Category', 'rules' => 'required'
        ),
        array(
            'field' => 'hsn', 'label' => 'HSN', 'rules' => 'required|numeric'
        ),
        array(
            'field' => 'i_gst', 'label' => 'I GST', 'rules' => 'required|numeric|min_length[1]|max_length[2]'
        )
    ),
    'product_add_desc' => array(
        array(
            'field' => 'weight', 'label' => 'weight', 'rules' => 'required'
        ),
        array(
            'field' => 'mrp', 'label' => 'mrp', 'rules' => 'required'
        ),
        array(
            'field' => 'barcode', 'label' => 'barcode', 'rules' => 'required'
        ),
        array(
            'field' => 'stock', 'label' => 'stock', 'rules' => 'required'
        ),
        array(
            'field' => 'value', 'label' => 'value', 'rules' => 'required'
        )
    ),
    'edit_product_desc' => array(
        array(
            'field' => 'weight', 'label' => 'weight', 'rules' => 'required'
        ),
        array(
            'field' => 'mrp', 'label' => 'mrp', 'rules' => 'required'
        ),
        array(
            'field' => 'barcode', 'label' => 'barcode', 'rules' => 'required'
        ),
        array(
            'field' => 'stock', 'label' => 'stock', 'rules' => 'required'
        ),
        array(
            'field' => 'sale_price', 'label' => 'value', 'rules' => 'required'
        )
    ),
    'add_brand' => array(
        array(
            'field' => 'name', 'label' => 'weight', 'rules' => 'required'
        ),
        array(
            'field' => 'bill_name', 'label' => 'mrp', 'rules' => 'required'
        ),
        array(
            'field' => 'contact_no', 'label' => 'barcode', 'rules' => 'required|min_length[10]|max_length[10]'
        ),
        array(
            'field' => 'email', 'label' => 'stock', 'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'gst', 'label' => 'value', 'rules' => 'required'
        ),
        array(
            'field' => 'pan_no', 'label' => 'value', 'rules' => 'required'
        ),
        array(
            'field' => 'address', 'label' => 'value', 'rules' => 'required'
        )
    ),
    'add_party' => array(
        array(
            'field' => 'name', 'label' => 'name', 'rules' => 'required'
        ),
        array(
            'field' => 'address', 'label' => 'address', 'rules' => 'required'
        ),
        array(
            'field' => 'city', 'label' => 'city', 'rules' => ''
        ),
        array(
            'field' => 'state_id', 'label' => 'state', 'rules' => 'required'
        ),
        array(
            'field' => 'pincode', 'label' => 'pincode', 'rules' => 'min_length[6]|max_length[6]'
        ),
        array(
            'field' => 'landmark', 'label' => 'landmark', 'rules' => ''
        ),
        array(
            'field' => 'contact', 'label' => 'contact', 'rules' => 'required|min_length[10]|max_length[10]|is_unique[manage_party.contact_no]'
        ),
        array(
            'field' => 'contact_person', 'label' => 'contact person', 'rules' => 'min_length[10]|max_length[10]'
        ),
        array(
            'field' => 'email', 'label' => 'eamil', 'rules' => 'valid_email'
        ),
        array(
            'field' => 'gst_in', 'label' => 'GST IN', 'rules' => ''
        ),
        array(
            'field' => 'limit_1', 'label' => 'Limit', 'rules' => 'required'
        ),
        array(
            'field' => 'ffsi_no', 'label' => 'FFSI No', 'rules' => ''
        ),
        array(
            'field' => 'discount', 'label' => 'discount', 'rules' => 'required'
        )
    ),
    'edit_party' => array(
        array(
            'field' => 'name', 'label' => 'name', 'rules' => 'required'
        ),
        array(
            'field' => 'address', 'label' => 'address', 'rules' => 'required'
        ),
        array(
            'field' => 'city', 'label' => 'city', 'rules' => ''
        ),
        array(
            'field' => 'state_id', 'label' => 'state', 'rules' => 'required'
        ),
        array(
            'field' => 'pincode', 'label' => 'pincode', 'rules' => 'min_length[6]|max_length[6]'
        ),
        array(
            'field' => 'landmark', 'label' => 'landmark', 'rules' => ''
        ),
        array(
            'field' => 'contact', 'label' => 'contact', 'rules' => 'required|min_length[10]|max_length[10]'//|is_unique[manage_party.contact_no]
        ),
        array(
            'field' => 'contact_person', 'label' => 'contact person', 'rules' => ''//min_length[10]|max_length[10]
        ),
        array(
            'field' => 'email', 'label' => 'eamil', 'rules' => 'valid_email'
        ),
        array(
            'field' => 'gst_in', 'label' => 'GST IN', 'rules' => ''
        ),
        array(
            'field' => 'limit_1', 'label' => 'Limit', 'rules' => 'required'
        ),
        array(
            'field' => 'ffsi_no', 'label' => 'FFSI No', 'rules' => ''
        ),
        array(
            'field' => 'discount', 'label' => 'discount', 'rules' => 'required'
        )
    ),
    'add_vendor' => array(
        array(
            'field' => 'name', 'label' => 'name', 'rules' => 'required'
        ),
        array(
            'field' => 'email', 'label' => 'address', 'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'contact', 'label' => 'city', 'rules' => 'required|min_length[10]|max_length[10]'
        ),
        array(
            'field' => 'city', 'label' => 'state', 'rules' => 'required'
        ),
        array(
            'field' => 'state_id', 'label' => 'pincode', 'rules' => 'required'
        ),
        array(
            'field' => 'pincode', 'label' => 'landmark', 'rules' => 'required|min_length[6]|max_length[6]'
        ),
        array(
            'field' => 'gstin', 'label' => 'contact', 'rules' => ''//|is_unique[manage_party.contact_no]
        ),
        array(
            'field' => 'address', 'label' => 'contact person', 'rules' => 'required'//min_length[10]|max_length[10]
        )
    )
);

?>