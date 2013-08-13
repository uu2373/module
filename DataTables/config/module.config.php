<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'datatables_data_service' => 'DataTables\Service\Data'
            ),
            'Zend\View\HelperLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'datatable' => 'DataTables\View\Helper\DataTable',
                    ),
                ),
            ),
        )
    )
);
