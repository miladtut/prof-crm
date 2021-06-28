<?php
// Aside menu
return [

    'admin-items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/profectadmin',
            'new-tab' => false,
        ],

        // Main
        [
            'section' => 'Main',
        ],
        [
            'title' => 'Inquiries',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'arrow'=>true,
            'submenu' => [
                [
                    'title' => 'Regular Inquiries',
                    'page'=>'/profectadmin/inquiries?type=regular',
                ],
                [
                    'title' => 'Logistic Inquiries',
                    'page'=>'/profectadmin/inquiries?type=logistic',
                ],

            ]
        ],

        // Data
        [
            'section' => 'Data',
        ],
        [
            'title' => 'Companies',
            'desc' => '',
            'icon' => 'media/svg/icons/Code/Compiling.svg',
            'root' => true,
            'page'=>'profectadmin/companies'

        ],
        [
            'title' => 'Suppliers',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'root' => true,
            'page'=>'profectadmin/suppliers'
        ],
        [
            'title' => 'Admins',
            'rule' => 'super_admin',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Library.svg',
            'page' => 'profectadmin/admins',
            'visible' => 'preview',
        ],
//        [
//            'title' => 'Messages',
//            'icon' => 'media/svg/icons/Communication/Mail.svg',
//            'root' => true,
//            'page'=>'/icons/flaticon'
//        ],

        // System
        [
            'section' => 'System',
        ],
        [
            'title' => 'System Variables',
            'icon' => 'media/svg/icons/Shopping/Box2.svg',
            'root' => true,
            'bullet' => 'line',
            'arrow'=>true,
            'submenu' => [
                [
                    'title' => 'Materials',
                    'desc' => '',
                    'page' => 'profectadmin/materials',
                ],
                [
                    'title' => 'Specs',
                    'desc' => '',
                    'page' => 'profectadmin/specs',
                ],
                [
                    'title' => 'Documents',
                    'desc' => '',
                    'page' => 'profectadmin/documents',
                ],
                [
                    'title' => 'Customer Documents',
                    'desc' => '',
                    'page' => 'profectadmin/cdocuments',
                ],
                [
                    'title' => 'Countries',
                    'desc' => '',
                    'page' => 'profectadmin/countries',
                ],
                [
                    'title' => 'Currencies',
                    'desc' => '',
                    'page' => 'profectadmin/currencies',
                ],
                [
                    'title' => 'Payment Terms',
                    'desc' => '',
                    'page' => 'profectadmin/payment/terms',
                ],
                [
                    'title' => 'Shipping Terms',
                    'desc' => '',
                    'page' => 'profectadmin/shipping/terms',
                ],
            ]
        ],
        [
            'title' => 'System settings',
            'icon' => 'media/svg/icons/Shopping/Box1.svg',
            'root' => true,
            'bullet' => 'line',
            'arrow'=>true,
            'submenu' => [
                [
                    'title' => 'about us',
                    'desc' => '',
                    'page' => 'profectadmin/about-profect/edit',
                ],
            ]
        ],

    ],
    'company-items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'companyadmin/dashboard',
            'new-tab' => false,
        ],

        // Main
        [
            'section' => 'Main',
        ],
        [
            'title' => 'Inquiries',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'arrow'=>true,
            'submenu' => [
                [
                    'title' => 'All Inquiries',
                    'page'=>'companyadmin/inquiries'
                ],
                [
                    'title' => 'On Going Inquiries',
                    'page'=>'companyadmin/inquiries?status_name=ongoing',
                ],
                [
                    'title' => 'Finished Inquiries',
                    'page'=>'companyadmin/inquiries?status_name=closed',
                ],
                [
                    'title' => 'Declined Inquiries',
                    'page'=>'companyadmin/inquiries?status_name=declined',
                ],

            ]
        ],

        // Profect investments
        [
            'section' => 'Profect Investments',
        ],
        [
            'title' => 'About Profect',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'root' => true,
            'page'=>'companyadmin/about-profect'
        ],
        [
            'title' => 'Suppliers Documents',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Library.svg',
            'page' => 'companyadmin/profect-partners',
            'visible' => 'preview',
        ],

        // Account
        [
            'section' => 'Account',
        ],
        [
            'title' => 'Notifications Center',
            'icon' => 'media/svg/icons/Shopping/Box2.svg',
            'root' => true,
            'page'=>'companyadmin/notifications'
        ],
        [
            'title' => 'Edit Account',
            'icon' => 'media/svg/icons/Files/Pictures1.svg',
            'root' => true,
            'page'=>'companyadmin/account-edit'
        ],
        [
            'title' => 'Change Password',
            'icon' => 'media/svg/icons/Home/Mirror.svg',
            'root' => true,
            'page'=>'companyadmin/change-password'
        ],

    ],

];
