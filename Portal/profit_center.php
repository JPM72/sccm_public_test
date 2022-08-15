<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class profit_center_quotePage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Quote');
            $this->SetMenuLabel('Quote');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`quote`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('quote_number'),
                    new StringField('client_order_no', true),
                    new StringField('client_quote_no', true),
                    new DateField('client_order_date'),
                    new DateField('valid_from'),
                    new IntegerField('service_frequency', true),
                    new IntegerField('contract_duration', true),
                    new IntegerField('site_quoted', true),
                    new StringField('service_start_date'),
                    new StringField('sap_quote_no'),
                    new StringField('debtors_no'),
                    new StringField('contract_code'),
                    new StringField('j_number'),
                    new StringField('service_description', true),
                    new StringField('special_notes'),
                    new StringField('status'),
                    new IntegerField('total_contract_price'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new IntegerField('region'),
                    new IntegerField('sales_district'),
                    new StringField('sales_district_sap'),
                    new StringField('sales_exec_code'),
                    new StringField('sales_exec_name'),
                    new StringField('area_manager_code'),
                    new StringField('area_manager_name'),
                    new StringField('regional_manager_name'),
                    new IntegerField('profit_center'),
                    new StringField('sales_stage'),
                    new DateField('present_date'),
                    new DateField('award_date'),
                    new DateField('start_date'),
                    new IntegerField('created_by'),
                    new IntegerField('last_updated_by'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $this->dataset->AddLookupField('service_frequency', 'service_frequency', new IntegerField('id'), new StringField('frequency', false, false, false, false, 'service_frequency_frequency', 'service_frequency_frequency_service_frequency'), 'service_frequency_frequency_service_frequency');
            $this->dataset->AddLookupField('contract_duration', 'contract_duration', new IntegerField('id'), new StringField('duration', false, false, false, false, 'contract_duration_duration', 'contract_duration_duration_contract_duration'), 'contract_duration_duration_contract_duration');
            $this->dataset->AddLookupField('site_quoted', 'customer_site_quoted', new IntegerField('id'), new StringField('site_name', false, false, false, false, 'site_quoted_site_name', 'site_quoted_site_name_customer_site_quoted'), 'site_quoted_site_name_customer_site_quoted');
            $this->dataset->AddLookupField('sales_org', 'sales_org', new IntegerField('Id'), new StringField('name', false, false, false, false, 'sales_org_name', 'sales_org_name_sales_org'), 'sales_org_name_sales_org');
            $this->dataset->AddLookupField('sales_division', 'sales_division', new IntegerField('Id'), new StringField('name', false, false, false, false, 'sales_division_name', 'sales_division_name_sales_division'), 'sales_division_name_sales_division');
            $this->dataset->AddLookupField('region', 'region', new IntegerField('Id'), new StringField('RegionName', false, false, false, false, 'region_RegionName', 'region_RegionName_region'), 'region_RegionName_region');
            $this->dataset->AddLookupField('sales_district', 'sales_district', new IntegerField('Id'), new StringField('DistrictName', false, false, false, false, 'sales_district_DistrictName', 'sales_district_DistrictName_sales_district'), 'sales_district_DistrictName_sales_district');
            $this->dataset->AddLookupField('profit_center', 'profit_center', new IntegerField('Id'), new StringField('name', false, false, false, false, 'profit_center_name', 'profit_center_name_profit_center'), 'profit_center_name_profit_center');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'quote_number', 'quote_number', 'Quote Number'),
                new FilterColumn($this->dataset, 'client_order_no', 'client_order_no', 'Client Order No'),
                new FilterColumn($this->dataset, 'client_quote_no', 'client_quote_no', 'Client Quote No'),
                new FilterColumn($this->dataset, 'client_order_date', 'client_order_date', 'Client Order Date'),
                new FilterColumn($this->dataset, 'valid_from', 'valid_from', 'Valid From'),
                new FilterColumn($this->dataset, 'service_frequency', 'service_frequency_frequency', 'Service Frequency'),
                new FilterColumn($this->dataset, 'contract_duration', 'contract_duration_duration', 'Contract Duration'),
                new FilterColumn($this->dataset, 'site_quoted', 'site_quoted_site_name', 'Site Quoted'),
                new FilterColumn($this->dataset, 'service_start_date', 'service_start_date', 'Service Start Date'),
                new FilterColumn($this->dataset, 'sap_quote_no', 'sap_quote_no', 'Sap Quote No'),
                new FilterColumn($this->dataset, 'debtors_no', 'debtors_no', 'Debtors No'),
                new FilterColumn($this->dataset, 'contract_code', 'contract_code', 'Contract Code'),
                new FilterColumn($this->dataset, 'j_number', 'j_number', 'J Number'),
                new FilterColumn($this->dataset, 'service_description', 'service_description', 'Service Description'),
                new FilterColumn($this->dataset, 'special_notes', 'special_notes', 'Special Notes'),
                new FilterColumn($this->dataset, 'status', 'status', 'Status'),
                new FilterColumn($this->dataset, 'total_contract_price', 'total_contract_price', 'Total Contract Price'),
                new FilterColumn($this->dataset, 'sales_org', 'sales_org_name', 'Sales Org'),
                new FilterColumn($this->dataset, 'sales_division', 'sales_division_name', 'Sales Division'),
                new FilterColumn($this->dataset, 'region', 'region_RegionName', 'Region'),
                new FilterColumn($this->dataset, 'sales_district', 'sales_district_DistrictName', 'Sales District'),
                new FilterColumn($this->dataset, 'sales_exec_code', 'sales_exec_code', 'Sales Exec Code'),
                new FilterColumn($this->dataset, 'sales_exec_name', 'sales_exec_name', 'Sales Exec Name'),
                new FilterColumn($this->dataset, 'area_manager_code', 'area_manager_code', 'Area Manager Code'),
                new FilterColumn($this->dataset, 'area_manager_name', 'area_manager_name', 'Area Manager Name'),
                new FilterColumn($this->dataset, 'regional_manager_name', 'regional_manager_name', 'Regional Manager Name'),
                new FilterColumn($this->dataset, 'profit_center', 'profit_center_name', 'Profit Center'),
                new FilterColumn($this->dataset, 'sales_stage', 'sales_stage', 'Sales Stage'),
                new FilterColumn($this->dataset, 'present_date', 'present_date', 'Present Date'),
                new FilterColumn($this->dataset, 'award_date', 'award_date', 'Award Date'),
                new FilterColumn($this->dataset, 'start_date', 'start_date', 'Start Date'),
                new FilterColumn($this->dataset, 'created_by', 'created_by', 'Created By'),
                new FilterColumn($this->dataset, 'last_updated_by', 'last_updated_by', 'Last Updated By'),
                new FilterColumn($this->dataset, 'upd_date', 'upd_date', 'Upd Date'),
                new FilterColumn($this->dataset, 'create_date', 'create_date', 'Create Date'),
                new FilterColumn($this->dataset, 'sales_district_sap', 'sales_district_sap', 'Sales District Sap')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['quote_number'])
                ->addColumn($columns['client_order_no'])
                ->addColumn($columns['client_quote_no'])
                ->addColumn($columns['client_order_date'])
                ->addColumn($columns['valid_from'])
                ->addColumn($columns['service_frequency'])
                ->addColumn($columns['contract_duration'])
                ->addColumn($columns['site_quoted'])
                ->addColumn($columns['service_start_date'])
                ->addColumn($columns['sap_quote_no'])
                ->addColumn($columns['debtors_no'])
                ->addColumn($columns['contract_code'])
                ->addColumn($columns['j_number'])
                ->addColumn($columns['service_description'])
                ->addColumn($columns['special_notes'])
                ->addColumn($columns['status'])
                ->addColumn($columns['total_contract_price'])
                ->addColumn($columns['sales_org'])
                ->addColumn($columns['sales_division'])
                ->addColumn($columns['region'])
                ->addColumn($columns['sales_district'])
                ->addColumn($columns['sales_exec_code'])
                ->addColumn($columns['sales_exec_name'])
                ->addColumn($columns['area_manager_code'])
                ->addColumn($columns['area_manager_name'])
                ->addColumn($columns['regional_manager_name'])
                ->addColumn($columns['profit_center'])
                ->addColumn($columns['sales_stage'])
                ->addColumn($columns['present_date'])
                ->addColumn($columns['award_date'])
                ->addColumn($columns['start_date'])
                ->addColumn($columns['created_by'])
                ->addColumn($columns['last_updated_by'])
                ->addColumn($columns['upd_date'])
                ->addColumn($columns['create_date'])
                ->addColumn($columns['sales_district_sap']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('client_order_date')
                ->setOptionsFor('valid_from')
                ->setOptionsFor('service_frequency')
                ->setOptionsFor('contract_duration')
                ->setOptionsFor('site_quoted')
                ->setOptionsFor('sales_org')
                ->setOptionsFor('sales_division')
                ->setOptionsFor('region')
                ->setOptionsFor('sales_district')
                ->setOptionsFor('profit_center')
                ->setOptionsFor('present_date')
                ->setOptionsFor('award_date')
                ->setOptionsFor('start_date')
                ->setOptionsFor('upd_date')
                ->setOptionsFor('create_date');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('quote_number_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['quote_number'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('client_order_no_edit');
            $main_editor->SetMaxLength(40);
            
            $filterBuilder->addColumn(
                $columns['client_order_no'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('client_quote_no_edit');
            $main_editor->SetMaxLength(40);
            
            $filterBuilder->addColumn(
                $columns['client_quote_no'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('client_order_date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['client_order_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('valid_from_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['valid_from'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('service_frequency_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_service_frequency_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('service_frequency', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_service_frequency_search');
            
            $text_editor = new TextEdit('service_frequency');
            
            $filterBuilder->addColumn(
                $columns['service_frequency'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('contract_duration_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_contract_duration_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('contract_duration', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_contract_duration_search');
            
            $text_editor = new TextEdit('contract_duration');
            
            $filterBuilder->addColumn(
                $columns['contract_duration'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('site_quoted_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_site_quoted_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('site_quoted', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_site_quoted_search');
            
            $text_editor = new TextEdit('site_quoted');
            
            $filterBuilder->addColumn(
                $columns['site_quoted'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('service_start_date_edit');
            $main_editor->SetMaxLength(40);
            
            $filterBuilder->addColumn(
                $columns['service_start_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('sap_quote_no_edit');
            $main_editor->SetMaxLength(40);
            
            $filterBuilder->addColumn(
                $columns['sap_quote_no'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('debtors_no_edit');
            $main_editor->SetMaxLength(40);
            
            $filterBuilder->addColumn(
                $columns['debtors_no'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('contract_code_edit');
            $main_editor->SetMaxLength(40);
            
            $filterBuilder->addColumn(
                $columns['contract_code'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('j_number_edit');
            $main_editor->SetMaxLength(40);
            
            $filterBuilder->addColumn(
                $columns['j_number'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('service_description');
            
            $filterBuilder->addColumn(
                $columns['service_description'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('special_notes');
            
            $filterBuilder->addColumn(
                $columns['special_notes'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('status');
            
            $filterBuilder->addColumn(
                $columns['status'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('total_contract_price_edit');
            
            $filterBuilder->addColumn(
                $columns['total_contract_price'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_sales_org_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('sales_org', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_sales_org_search');
            
            $text_editor = new TextEdit('sales_org');
            
            $filterBuilder->addColumn(
                $columns['sales_org'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_sales_division_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('sales_division', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_sales_division_search');
            
            $text_editor = new TextEdit('sales_division');
            
            $filterBuilder->addColumn(
                $columns['sales_division'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('region_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_region_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('region', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_region_search');
            
            $text_editor = new TextEdit('region');
            
            $filterBuilder->addColumn(
                $columns['region'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('sales_district_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_sales_district_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('sales_district', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_sales_district_search');
            
            $text_editor = new TextEdit('sales_district');
            
            $filterBuilder->addColumn(
                $columns['sales_district'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('sales_exec_code');
            
            $filterBuilder->addColumn(
                $columns['sales_exec_code'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('sales_exec_name');
            
            $filterBuilder->addColumn(
                $columns['sales_exec_name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('area_manager_code');
            
            $filterBuilder->addColumn(
                $columns['area_manager_code'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('area_manager_name');
            
            $filterBuilder->addColumn(
                $columns['area_manager_name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('regional_manager_name');
            
            $filterBuilder->addColumn(
                $columns['regional_manager_name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('profit_center_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_quote_profit_center_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('profit_center', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_quote_profit_center_search');
            
            $text_editor = new TextEdit('profit_center');
            
            $filterBuilder->addColumn(
                $columns['profit_center'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('sales_stage');
            
            $filterBuilder->addColumn(
                $columns['sales_stage'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('present_date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['present_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('award_date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['award_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('start_date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['start_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('created_by_edit');
            
            $filterBuilder->addColumn(
                $columns['created_by'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('last_updated_by_edit');
            
            $filterBuilder->addColumn(
                $columns['last_updated_by'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('upd_date_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['upd_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['create_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('sales_district_sap');
            
            $filterBuilder->addColumn(
                $columns['sales_district_sap'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for quote_number field
            //
            $column = new TextViewColumn('quote_number', 'quote_number', 'Quote Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for client_order_no field
            //
            $column = new TextViewColumn('client_order_no', 'client_order_no', 'Client Order No', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for client_quote_no field
            //
            $column = new TextViewColumn('client_quote_no', 'client_quote_no', 'Client Quote No', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for client_order_date field
            //
            $column = new DateTimeViewColumn('client_order_date', 'client_order_date', 'Client Order Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for frequency field
            //
            $column = new TextViewColumn('service_frequency', 'service_frequency_frequency', 'Service Frequency', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for duration field
            //
            $column = new TextViewColumn('contract_duration', 'contract_duration_duration', 'Contract Duration', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for site_name field
            //
            $column = new TextViewColumn('site_quoted', 'site_quoted_site_name', 'Site Quoted', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_start_date field
            //
            $column = new TextViewColumn('service_start_date', 'service_start_date', 'Service Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sap_quote_no field
            //
            $column = new TextViewColumn('sap_quote_no', 'sap_quote_no', 'Sap Quote No', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for debtors_no field
            //
            $column = new TextViewColumn('debtors_no', 'debtors_no', 'Debtors No', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for contract_code field
            //
            $column = new TextViewColumn('contract_code', 'contract_code', 'Contract Code', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for j_number field
            //
            $column = new TextViewColumn('j_number', 'j_number', 'J Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_description field
            //
            $column = new TextViewColumn('service_description', 'service_description', 'Service Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for special_notes field
            //
            $column = new TextViewColumn('special_notes', 'special_notes', 'Special Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for total_contract_price field
            //
            $column = new NumberViewColumn('total_contract_price', 'total_contract_price', 'Total Contract Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('region', 'region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('sales_district', 'sales_district_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sales_exec_code field
            //
            $column = new TextViewColumn('sales_exec_code', 'sales_exec_code', 'Sales Exec Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sales_exec_name field
            //
            $column = new TextViewColumn('sales_exec_name', 'sales_exec_name', 'Sales Exec Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for area_manager_code field
            //
            $column = new TextViewColumn('area_manager_code', 'area_manager_code', 'Area Manager Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for area_manager_name field
            //
            $column = new TextViewColumn('area_manager_name', 'area_manager_name', 'Area Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for regional_manager_name field
            //
            $column = new TextViewColumn('regional_manager_name', 'regional_manager_name', 'Regional Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('profit_center', 'profit_center_name', 'Profit Center', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sales_stage field
            //
            $column = new TextViewColumn('sales_stage', 'sales_stage', 'Sales Stage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for present_date field
            //
            $column = new DateTimeViewColumn('present_date', 'present_date', 'Present Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for award_date field
            //
            $column = new DateTimeViewColumn('award_date', 'award_date', 'Award Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for start_date field
            //
            $column = new DateTimeViewColumn('start_date', 'start_date', 'Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_by field
            //
            $column = new NumberViewColumn('created_by', 'created_by', 'Created By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for last_updated_by field
            //
            $column = new NumberViewColumn('last_updated_by', 'last_updated_by', 'Last Updated By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for upd_date field
            //
            $column = new DateTimeViewColumn('upd_date', 'upd_date', 'Upd Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sales_district_sap field
            //
            $column = new TextViewColumn('sales_district_sap', 'sales_district_sap', 'Sales District Sap', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for quote_number field
            //
            $column = new TextViewColumn('quote_number', 'quote_number', 'Quote Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for client_order_no field
            //
            $column = new TextViewColumn('client_order_no', 'client_order_no', 'Client Order No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for client_quote_no field
            //
            $column = new TextViewColumn('client_quote_no', 'client_quote_no', 'Client Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for client_order_date field
            //
            $column = new DateTimeViewColumn('client_order_date', 'client_order_date', 'Client Order Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for frequency field
            //
            $column = new TextViewColumn('service_frequency', 'service_frequency_frequency', 'Service Frequency', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for duration field
            //
            $column = new TextViewColumn('contract_duration', 'contract_duration_duration', 'Contract Duration', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for site_name field
            //
            $column = new TextViewColumn('site_quoted', 'site_quoted_site_name', 'Site Quoted', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_start_date field
            //
            $column = new TextViewColumn('service_start_date', 'service_start_date', 'Service Start Date', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sap_quote_no field
            //
            $column = new TextViewColumn('sap_quote_no', 'sap_quote_no', 'Sap Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for debtors_no field
            //
            $column = new TextViewColumn('debtors_no', 'debtors_no', 'Debtors No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for contract_code field
            //
            $column = new TextViewColumn('contract_code', 'contract_code', 'Contract Code', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for j_number field
            //
            $column = new TextViewColumn('j_number', 'j_number', 'J Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_description field
            //
            $column = new TextViewColumn('service_description', 'service_description', 'Service Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for special_notes field
            //
            $column = new TextViewColumn('special_notes', 'special_notes', 'Special Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for total_contract_price field
            //
            $column = new NumberViewColumn('total_contract_price', 'total_contract_price', 'Total Contract Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('region', 'region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('sales_district', 'sales_district_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sales_exec_code field
            //
            $column = new TextViewColumn('sales_exec_code', 'sales_exec_code', 'Sales Exec Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sales_exec_name field
            //
            $column = new TextViewColumn('sales_exec_name', 'sales_exec_name', 'Sales Exec Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for area_manager_code field
            //
            $column = new TextViewColumn('area_manager_code', 'area_manager_code', 'Area Manager Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for area_manager_name field
            //
            $column = new TextViewColumn('area_manager_name', 'area_manager_name', 'Area Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for regional_manager_name field
            //
            $column = new TextViewColumn('regional_manager_name', 'regional_manager_name', 'Regional Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('profit_center', 'profit_center_name', 'Profit Center', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sales_stage field
            //
            $column = new TextViewColumn('sales_stage', 'sales_stage', 'Sales Stage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for present_date field
            //
            $column = new DateTimeViewColumn('present_date', 'present_date', 'Present Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for award_date field
            //
            $column = new DateTimeViewColumn('award_date', 'award_date', 'Award Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for start_date field
            //
            $column = new DateTimeViewColumn('start_date', 'start_date', 'Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_by field
            //
            $column = new NumberViewColumn('created_by', 'created_by', 'Created By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for last_updated_by field
            //
            $column = new NumberViewColumn('last_updated_by', 'last_updated_by', 'Last Updated By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for upd_date field
            //
            $column = new DateTimeViewColumn('upd_date', 'upd_date', 'Upd Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sales_district_sap field
            //
            $column = new TextViewColumn('sales_district_sap', 'sales_district_sap', 'Sales District Sap', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for quote_number field
            //
            $editor = new TextEdit('quote_number_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Quote Number', 'quote_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for client_order_no field
            //
            $editor = new TextEdit('client_order_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Client Order No', 'client_order_no', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for client_quote_no field
            //
            $editor = new TextEdit('client_quote_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Client Quote No', 'client_quote_no', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for client_order_date field
            //
            $editor = new DateTimeEdit('client_order_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Client Order Date', 'client_order_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for valid_from field
            //
            $editor = new DateTimeEdit('valid_from_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Valid From', 'valid_from', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_frequency field
            //
            $editor = new DynamicCombobox('service_frequency_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service_frequency`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('frequency'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('frequency', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Service Frequency', 'service_frequency', 'service_frequency_frequency', 'edit_profit_center_quote_service_frequency_search', $editor, $this->dataset, $lookupDataset, 'id', 'frequency', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for contract_duration field
            //
            $editor = new DynamicCombobox('contract_duration_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contract_duration`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('duration'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('duration', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Contract Duration', 'contract_duration', 'contract_duration_duration', 'edit_profit_center_quote_contract_duration_search', $editor, $this->dataset, $lookupDataset, 'id', 'duration', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for site_quoted field
            //
            $editor = new DynamicCombobox('site_quoted_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`customer_site_quoted`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('site_name', true),
                    new IntegerField('site_id'),
                    new IntegerField('customer_id', true),
                    new StringField('site_code'),
                    new StringField('vat_number'),
                    new StringField('contact_person'),
                    new StringField('email_address'),
                    new StringField('tel_number'),
                    new StringField('cell_number'),
                    new StringField('fax_number'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('site_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Site Quoted', 'site_quoted', 'site_quoted_site_name', 'edit_profit_center_quote_site_quoted_search', $editor, $this->dataset, $lookupDataset, 'id', 'site_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_start_date field
            //
            $editor = new TextEdit('service_start_date_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Service Start Date', 'service_start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sap_quote_no field
            //
            $editor = new TextEdit('sap_quote_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Sap Quote No', 'sap_quote_no', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for debtors_no field
            //
            $editor = new TextEdit('debtors_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Debtors No', 'debtors_no', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for contract_code field
            //
            $editor = new TextEdit('contract_code_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Contract Code', 'contract_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for j_number field
            //
            $editor = new TextEdit('j_number_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('J Number', 'j_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_description field
            //
            $editor = new TextAreaEdit('service_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Service Description', 'service_description', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for special_notes field
            //
            $editor = new TextAreaEdit('special_notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Special Notes', 'special_notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for status field
            //
            $editor = new TextAreaEdit('status_edit', 50, 8);
            $editColumn = new CustomEditColumn('Status', 'status', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for total_contract_price field
            //
            $editor = new TextEdit('total_contract_price_edit');
            $editColumn = new CustomEditColumn('Total Contract Price', 'total_contract_price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_org field
            //
            $editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Org', 'sales_org', 'sales_org_name', 'edit_profit_center_quote_sales_org_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_division field
            //
            $editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Division', 'sales_division', 'sales_division_name', 'edit_profit_center_quote_sales_division_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for region field
            //
            $editor = new DynamicCombobox('region_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Region', 'region', 'region_RegionName', 'edit_profit_center_quote_region_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_district field
            //
            $editor = new DynamicCombobox('sales_district_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales District', 'sales_district', 'sales_district_DistrictName', 'edit_profit_center_quote_sales_district_search', $editor, $this->dataset, $lookupDataset, 'Id', 'DistrictName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_exec_code field
            //
            $editor = new TextAreaEdit('sales_exec_code_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Exec Code', 'sales_exec_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_exec_name field
            //
            $editor = new TextAreaEdit('sales_exec_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Exec Name', 'sales_exec_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for area_manager_code field
            //
            $editor = new TextAreaEdit('area_manager_code_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area Manager Code', 'area_manager_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for area_manager_name field
            //
            $editor = new TextAreaEdit('area_manager_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area Manager Name', 'area_manager_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for regional_manager_name field
            //
            $editor = new TextAreaEdit('regional_manager_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Regional Manager Name', 'regional_manager_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for profit_center field
            //
            $editor = new DynamicCombobox('profit_center_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Profit Center', 'profit_center', 'profit_center_name', 'edit_profit_center_quote_profit_center_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_stage field
            //
            $editor = new TextAreaEdit('sales_stage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Stage', 'sales_stage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for present_date field
            //
            $editor = new DateTimeEdit('present_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Present Date', 'present_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for award_date field
            //
            $editor = new DateTimeEdit('award_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Award Date', 'award_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for start_date field
            //
            $editor = new DateTimeEdit('start_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Start Date', 'start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_by field
            //
            $editor = new TextEdit('created_by_edit');
            $editColumn = new CustomEditColumn('Created By', 'created_by', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for last_updated_by field
            //
            $editor = new TextEdit('last_updated_by_edit');
            $editColumn = new CustomEditColumn('Last Updated By', 'last_updated_by', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for upd_date field
            //
            $editor = new DateTimeEdit('upd_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Upd Date', 'upd_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for create_date field
            //
            $editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Create Date', 'create_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_district_sap field
            //
            $editor = new TextAreaEdit('sales_district_sap_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales District Sap', 'sales_district_sap', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for quote_number field
            //
            $editor = new TextEdit('quote_number_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Quote Number', 'quote_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for client_order_no field
            //
            $editor = new TextEdit('client_order_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Client Order No', 'client_order_no', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for client_quote_no field
            //
            $editor = new TextEdit('client_quote_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Client Quote No', 'client_quote_no', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for client_order_date field
            //
            $editor = new DateTimeEdit('client_order_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Client Order Date', 'client_order_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for valid_from field
            //
            $editor = new DateTimeEdit('valid_from_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Valid From', 'valid_from', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_frequency field
            //
            $editor = new DynamicCombobox('service_frequency_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service_frequency`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('frequency'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('frequency', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Service Frequency', 'service_frequency', 'service_frequency_frequency', 'multi_edit_profit_center_quote_service_frequency_search', $editor, $this->dataset, $lookupDataset, 'id', 'frequency', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for contract_duration field
            //
            $editor = new DynamicCombobox('contract_duration_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contract_duration`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('duration'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('duration', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Contract Duration', 'contract_duration', 'contract_duration_duration', 'multi_edit_profit_center_quote_contract_duration_search', $editor, $this->dataset, $lookupDataset, 'id', 'duration', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for site_quoted field
            //
            $editor = new DynamicCombobox('site_quoted_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`customer_site_quoted`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('site_name', true),
                    new IntegerField('site_id'),
                    new IntegerField('customer_id', true),
                    new StringField('site_code'),
                    new StringField('vat_number'),
                    new StringField('contact_person'),
                    new StringField('email_address'),
                    new StringField('tel_number'),
                    new StringField('cell_number'),
                    new StringField('fax_number'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('site_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Site Quoted', 'site_quoted', 'site_quoted_site_name', 'multi_edit_profit_center_quote_site_quoted_search', $editor, $this->dataset, $lookupDataset, 'id', 'site_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_start_date field
            //
            $editor = new TextEdit('service_start_date_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Service Start Date', 'service_start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sap_quote_no field
            //
            $editor = new TextEdit('sap_quote_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Sap Quote No', 'sap_quote_no', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for debtors_no field
            //
            $editor = new TextEdit('debtors_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Debtors No', 'debtors_no', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for contract_code field
            //
            $editor = new TextEdit('contract_code_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Contract Code', 'contract_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for j_number field
            //
            $editor = new TextEdit('j_number_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('J Number', 'j_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_description field
            //
            $editor = new TextAreaEdit('service_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Service Description', 'service_description', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for special_notes field
            //
            $editor = new TextAreaEdit('special_notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Special Notes', 'special_notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for status field
            //
            $editor = new TextAreaEdit('status_edit', 50, 8);
            $editColumn = new CustomEditColumn('Status', 'status', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for total_contract_price field
            //
            $editor = new TextEdit('total_contract_price_edit');
            $editColumn = new CustomEditColumn('Total Contract Price', 'total_contract_price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_org field
            //
            $editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Org', 'sales_org', 'sales_org_name', 'multi_edit_profit_center_quote_sales_org_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_division field
            //
            $editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Division', 'sales_division', 'sales_division_name', 'multi_edit_profit_center_quote_sales_division_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for region field
            //
            $editor = new DynamicCombobox('region_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Region', 'region', 'region_RegionName', 'multi_edit_profit_center_quote_region_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_district field
            //
            $editor = new DynamicCombobox('sales_district_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales District', 'sales_district', 'sales_district_DistrictName', 'multi_edit_profit_center_quote_sales_district_search', $editor, $this->dataset, $lookupDataset, 'Id', 'DistrictName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_exec_code field
            //
            $editor = new TextAreaEdit('sales_exec_code_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Exec Code', 'sales_exec_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_exec_name field
            //
            $editor = new TextAreaEdit('sales_exec_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Exec Name', 'sales_exec_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for area_manager_code field
            //
            $editor = new TextAreaEdit('area_manager_code_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area Manager Code', 'area_manager_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for area_manager_name field
            //
            $editor = new TextAreaEdit('area_manager_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area Manager Name', 'area_manager_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for regional_manager_name field
            //
            $editor = new TextAreaEdit('regional_manager_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Regional Manager Name', 'regional_manager_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for profit_center field
            //
            $editor = new DynamicCombobox('profit_center_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Profit Center', 'profit_center', 'profit_center_name', 'multi_edit_profit_center_quote_profit_center_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_stage field
            //
            $editor = new TextAreaEdit('sales_stage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Stage', 'sales_stage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for present_date field
            //
            $editor = new DateTimeEdit('present_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Present Date', 'present_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for award_date field
            //
            $editor = new DateTimeEdit('award_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Award Date', 'award_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for start_date field
            //
            $editor = new DateTimeEdit('start_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Start Date', 'start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_by field
            //
            $editor = new TextEdit('created_by_edit');
            $editColumn = new CustomEditColumn('Created By', 'created_by', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for last_updated_by field
            //
            $editor = new TextEdit('last_updated_by_edit');
            $editColumn = new CustomEditColumn('Last Updated By', 'last_updated_by', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for upd_date field
            //
            $editor = new DateTimeEdit('upd_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Upd Date', 'upd_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for create_date field
            //
            $editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Create Date', 'create_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_district_sap field
            //
            $editor = new TextAreaEdit('sales_district_sap_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales District Sap', 'sales_district_sap', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for quote_number field
            //
            $editor = new TextEdit('quote_number_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Quote Number', 'quote_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for client_order_no field
            //
            $editor = new TextEdit('client_order_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Client Order No', 'client_order_no', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for client_quote_no field
            //
            $editor = new TextEdit('client_quote_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Client Quote No', 'client_quote_no', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for client_order_date field
            //
            $editor = new DateTimeEdit('client_order_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Client Order Date', 'client_order_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for valid_from field
            //
            $editor = new DateTimeEdit('valid_from_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Valid From', 'valid_from', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_frequency field
            //
            $editor = new DynamicCombobox('service_frequency_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service_frequency`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('frequency'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('frequency', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Service Frequency', 'service_frequency', 'service_frequency_frequency', 'insert_profit_center_quote_service_frequency_search', $editor, $this->dataset, $lookupDataset, 'id', 'frequency', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for contract_duration field
            //
            $editor = new DynamicCombobox('contract_duration_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contract_duration`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('duration'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('duration', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Contract Duration', 'contract_duration', 'contract_duration_duration', 'insert_profit_center_quote_contract_duration_search', $editor, $this->dataset, $lookupDataset, 'id', 'duration', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for site_quoted field
            //
            $editor = new DynamicCombobox('site_quoted_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`customer_site_quoted`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('site_name', true),
                    new IntegerField('site_id'),
                    new IntegerField('customer_id', true),
                    new StringField('site_code'),
                    new StringField('vat_number'),
                    new StringField('contact_person'),
                    new StringField('email_address'),
                    new StringField('tel_number'),
                    new StringField('cell_number'),
                    new StringField('fax_number'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('site_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Site Quoted', 'site_quoted', 'site_quoted_site_name', 'insert_profit_center_quote_site_quoted_search', $editor, $this->dataset, $lookupDataset, 'id', 'site_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_start_date field
            //
            $editor = new TextEdit('service_start_date_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Service Start Date', 'service_start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sap_quote_no field
            //
            $editor = new TextEdit('sap_quote_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Sap Quote No', 'sap_quote_no', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for debtors_no field
            //
            $editor = new TextEdit('debtors_no_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Debtors No', 'debtors_no', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for contract_code field
            //
            $editor = new TextEdit('contract_code_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('Contract Code', 'contract_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for j_number field
            //
            $editor = new TextEdit('j_number_edit');
            $editor->SetMaxLength(40);
            $editColumn = new CustomEditColumn('J Number', 'j_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_description field
            //
            $editor = new TextAreaEdit('service_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Service Description', 'service_description', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for special_notes field
            //
            $editor = new TextAreaEdit('special_notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Special Notes', 'special_notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for status field
            //
            $editor = new TextAreaEdit('status_edit', 50, 8);
            $editColumn = new CustomEditColumn('Status', 'status', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for total_contract_price field
            //
            $editor = new TextEdit('total_contract_price_edit');
            $editColumn = new CustomEditColumn('Total Contract Price', 'total_contract_price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_org field
            //
            $editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Org', 'sales_org', 'sales_org_name', 'insert_profit_center_quote_sales_org_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_division field
            //
            $editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Division', 'sales_division', 'sales_division_name', 'insert_profit_center_quote_sales_division_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for region field
            //
            $editor = new DynamicCombobox('region_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Region', 'region', 'region_RegionName', 'insert_profit_center_quote_region_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_district field
            //
            $editor = new DynamicCombobox('sales_district_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales District', 'sales_district', 'sales_district_DistrictName', 'insert_profit_center_quote_sales_district_search', $editor, $this->dataset, $lookupDataset, 'Id', 'DistrictName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_exec_code field
            //
            $editor = new TextAreaEdit('sales_exec_code_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Exec Code', 'sales_exec_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_exec_name field
            //
            $editor = new TextAreaEdit('sales_exec_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Exec Name', 'sales_exec_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for area_manager_code field
            //
            $editor = new TextAreaEdit('area_manager_code_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area Manager Code', 'area_manager_code', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for area_manager_name field
            //
            $editor = new TextAreaEdit('area_manager_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area Manager Name', 'area_manager_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for regional_manager_name field
            //
            $editor = new TextAreaEdit('regional_manager_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Regional Manager Name', 'regional_manager_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for profit_center field
            //
            $editor = new DynamicCombobox('profit_center_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Profit Center', 'profit_center', 'profit_center_name', 'insert_profit_center_quote_profit_center_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_stage field
            //
            $editor = new TextAreaEdit('sales_stage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales Stage', 'sales_stage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for present_date field
            //
            $editor = new DateTimeEdit('present_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Present Date', 'present_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for award_date field
            //
            $editor = new DateTimeEdit('award_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Award Date', 'award_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for start_date field
            //
            $editor = new DateTimeEdit('start_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Start Date', 'start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_by field
            //
            $editor = new TextEdit('created_by_edit');
            $editColumn = new CustomEditColumn('Created By', 'created_by', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for last_updated_by field
            //
            $editor = new TextEdit('last_updated_by_edit');
            $editColumn = new CustomEditColumn('Last Updated By', 'last_updated_by', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for upd_date field
            //
            $editor = new DateTimeEdit('upd_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Upd Date', 'upd_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for create_date field
            //
            $editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Create Date', 'create_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_district_sap field
            //
            $editor = new TextAreaEdit('sales_district_sap_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sales District Sap', 'sales_district_sap', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for quote_number field
            //
            $column = new TextViewColumn('quote_number', 'quote_number', 'Quote Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for client_order_no field
            //
            $column = new TextViewColumn('client_order_no', 'client_order_no', 'Client Order No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for client_quote_no field
            //
            $column = new TextViewColumn('client_quote_no', 'client_quote_no', 'Client Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for client_order_date field
            //
            $column = new DateTimeViewColumn('client_order_date', 'client_order_date', 'Client Order Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for frequency field
            //
            $column = new TextViewColumn('service_frequency', 'service_frequency_frequency', 'Service Frequency', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for duration field
            //
            $column = new TextViewColumn('contract_duration', 'contract_duration_duration', 'Contract Duration', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for site_name field
            //
            $column = new TextViewColumn('site_quoted', 'site_quoted_site_name', 'Site Quoted', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_start_date field
            //
            $column = new TextViewColumn('service_start_date', 'service_start_date', 'Service Start Date', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sap_quote_no field
            //
            $column = new TextViewColumn('sap_quote_no', 'sap_quote_no', 'Sap Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for debtors_no field
            //
            $column = new TextViewColumn('debtors_no', 'debtors_no', 'Debtors No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for contract_code field
            //
            $column = new TextViewColumn('contract_code', 'contract_code', 'Contract Code', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for j_number field
            //
            $column = new TextViewColumn('j_number', 'j_number', 'J Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_description field
            //
            $column = new TextViewColumn('service_description', 'service_description', 'Service Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for special_notes field
            //
            $column = new TextViewColumn('special_notes', 'special_notes', 'Special Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for total_contract_price field
            //
            $column = new NumberViewColumn('total_contract_price', 'total_contract_price', 'Total Contract Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('region', 'region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('sales_district', 'sales_district_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sales_exec_code field
            //
            $column = new TextViewColumn('sales_exec_code', 'sales_exec_code', 'Sales Exec Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sales_exec_name field
            //
            $column = new TextViewColumn('sales_exec_name', 'sales_exec_name', 'Sales Exec Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for area_manager_code field
            //
            $column = new TextViewColumn('area_manager_code', 'area_manager_code', 'Area Manager Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for area_manager_name field
            //
            $column = new TextViewColumn('area_manager_name', 'area_manager_name', 'Area Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for regional_manager_name field
            //
            $column = new TextViewColumn('regional_manager_name', 'regional_manager_name', 'Regional Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('profit_center', 'profit_center_name', 'Profit Center', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sales_stage field
            //
            $column = new TextViewColumn('sales_stage', 'sales_stage', 'Sales Stage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for present_date field
            //
            $column = new DateTimeViewColumn('present_date', 'present_date', 'Present Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for award_date field
            //
            $column = new DateTimeViewColumn('award_date', 'award_date', 'Award Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for start_date field
            //
            $column = new DateTimeViewColumn('start_date', 'start_date', 'Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_by field
            //
            $column = new NumberViewColumn('created_by', 'created_by', 'Created By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for last_updated_by field
            //
            $column = new NumberViewColumn('last_updated_by', 'last_updated_by', 'Last Updated By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for upd_date field
            //
            $column = new DateTimeViewColumn('upd_date', 'upd_date', 'Upd Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for sales_district_sap field
            //
            $column = new TextViewColumn('sales_district_sap', 'sales_district_sap', 'Sales District Sap', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for quote_number field
            //
            $column = new TextViewColumn('quote_number', 'quote_number', 'Quote Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for client_order_no field
            //
            $column = new TextViewColumn('client_order_no', 'client_order_no', 'Client Order No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for client_quote_no field
            //
            $column = new TextViewColumn('client_quote_no', 'client_quote_no', 'Client Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for client_order_date field
            //
            $column = new DateTimeViewColumn('client_order_date', 'client_order_date', 'Client Order Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for frequency field
            //
            $column = new TextViewColumn('service_frequency', 'service_frequency_frequency', 'Service Frequency', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for duration field
            //
            $column = new TextViewColumn('contract_duration', 'contract_duration_duration', 'Contract Duration', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for site_name field
            //
            $column = new TextViewColumn('site_quoted', 'site_quoted_site_name', 'Site Quoted', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for service_start_date field
            //
            $column = new TextViewColumn('service_start_date', 'service_start_date', 'Service Start Date', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for sap_quote_no field
            //
            $column = new TextViewColumn('sap_quote_no', 'sap_quote_no', 'Sap Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for debtors_no field
            //
            $column = new TextViewColumn('debtors_no', 'debtors_no', 'Debtors No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for contract_code field
            //
            $column = new TextViewColumn('contract_code', 'contract_code', 'Contract Code', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for j_number field
            //
            $column = new TextViewColumn('j_number', 'j_number', 'J Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for service_description field
            //
            $column = new TextViewColumn('service_description', 'service_description', 'Service Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for special_notes field
            //
            $column = new TextViewColumn('special_notes', 'special_notes', 'Special Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for total_contract_price field
            //
            $column = new NumberViewColumn('total_contract_price', 'total_contract_price', 'Total Contract Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('region', 'region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('sales_district', 'sales_district_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for sales_exec_code field
            //
            $column = new TextViewColumn('sales_exec_code', 'sales_exec_code', 'Sales Exec Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for sales_exec_name field
            //
            $column = new TextViewColumn('sales_exec_name', 'sales_exec_name', 'Sales Exec Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for area_manager_code field
            //
            $column = new TextViewColumn('area_manager_code', 'area_manager_code', 'Area Manager Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for area_manager_name field
            //
            $column = new TextViewColumn('area_manager_name', 'area_manager_name', 'Area Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for regional_manager_name field
            //
            $column = new TextViewColumn('regional_manager_name', 'regional_manager_name', 'Regional Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('profit_center', 'profit_center_name', 'Profit Center', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for sales_stage field
            //
            $column = new TextViewColumn('sales_stage', 'sales_stage', 'Sales Stage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for present_date field
            //
            $column = new DateTimeViewColumn('present_date', 'present_date', 'Present Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for award_date field
            //
            $column = new DateTimeViewColumn('award_date', 'award_date', 'Award Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for start_date field
            //
            $column = new DateTimeViewColumn('start_date', 'start_date', 'Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for created_by field
            //
            $column = new NumberViewColumn('created_by', 'created_by', 'Created By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for last_updated_by field
            //
            $column = new NumberViewColumn('last_updated_by', 'last_updated_by', 'Last Updated By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for upd_date field
            //
            $column = new DateTimeViewColumn('upd_date', 'upd_date', 'Upd Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for sales_district_sap field
            //
            $column = new TextViewColumn('sales_district_sap', 'sales_district_sap', 'Sales District Sap', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for quote_number field
            //
            $column = new TextViewColumn('quote_number', 'quote_number', 'Quote Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for client_order_no field
            //
            $column = new TextViewColumn('client_order_no', 'client_order_no', 'Client Order No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for client_quote_no field
            //
            $column = new TextViewColumn('client_quote_no', 'client_quote_no', 'Client Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for client_order_date field
            //
            $column = new DateTimeViewColumn('client_order_date', 'client_order_date', 'Client Order Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for frequency field
            //
            $column = new TextViewColumn('service_frequency', 'service_frequency_frequency', 'Service Frequency', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for duration field
            //
            $column = new TextViewColumn('contract_duration', 'contract_duration_duration', 'Contract Duration', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for site_name field
            //
            $column = new TextViewColumn('site_quoted', 'site_quoted_site_name', 'Site Quoted', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_start_date field
            //
            $column = new TextViewColumn('service_start_date', 'service_start_date', 'Service Start Date', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for sap_quote_no field
            //
            $column = new TextViewColumn('sap_quote_no', 'sap_quote_no', 'Sap Quote No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for debtors_no field
            //
            $column = new TextViewColumn('debtors_no', 'debtors_no', 'Debtors No', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for contract_code field
            //
            $column = new TextViewColumn('contract_code', 'contract_code', 'Contract Code', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for j_number field
            //
            $column = new TextViewColumn('j_number', 'j_number', 'J Number', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_description field
            //
            $column = new TextViewColumn('service_description', 'service_description', 'Service Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for special_notes field
            //
            $column = new TextViewColumn('special_notes', 'special_notes', 'Special Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for total_contract_price field
            //
            $column = new NumberViewColumn('total_contract_price', 'total_contract_price', 'Total Contract Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('region', 'region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('sales_district', 'sales_district_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for sales_exec_code field
            //
            $column = new TextViewColumn('sales_exec_code', 'sales_exec_code', 'Sales Exec Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for sales_exec_name field
            //
            $column = new TextViewColumn('sales_exec_name', 'sales_exec_name', 'Sales Exec Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for area_manager_code field
            //
            $column = new TextViewColumn('area_manager_code', 'area_manager_code', 'Area Manager Code', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for area_manager_name field
            //
            $column = new TextViewColumn('area_manager_name', 'area_manager_name', 'Area Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for regional_manager_name field
            //
            $column = new TextViewColumn('regional_manager_name', 'regional_manager_name', 'Regional Manager Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('profit_center', 'profit_center_name', 'Profit Center', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for sales_stage field
            //
            $column = new TextViewColumn('sales_stage', 'sales_stage', 'Sales Stage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for present_date field
            //
            $column = new DateTimeViewColumn('present_date', 'present_date', 'Present Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for award_date field
            //
            $column = new DateTimeViewColumn('award_date', 'award_date', 'Award Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for start_date field
            //
            $column = new DateTimeViewColumn('start_date', 'start_date', 'Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_by field
            //
            $column = new NumberViewColumn('created_by', 'created_by', 'Created By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for last_updated_by field
            //
            $column = new NumberViewColumn('last_updated_by', 'last_updated_by', 'Last Updated By', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for upd_date field
            //
            $column = new DateTimeViewColumn('upd_date', 'upd_date', 'Upd Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for sales_district_sap field
            //
            $column = new TextViewColumn('sales_district_sap', 'sales_district_sap', 'Sales District Sap', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service_frequency`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('frequency'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('frequency', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_service_frequency_search', 'id', 'frequency', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contract_duration`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('duration'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('duration', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_contract_duration_search', 'id', 'duration', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`customer_site_quoted`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('site_name', true),
                    new IntegerField('site_id'),
                    new IntegerField('customer_id', true),
                    new StringField('site_code'),
                    new StringField('vat_number'),
                    new StringField('contact_person'),
                    new StringField('email_address'),
                    new StringField('tel_number'),
                    new StringField('cell_number'),
                    new StringField('fax_number'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('site_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_site_quoted_search', 'id', 'site_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_region_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_quote_profit_center_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service_frequency`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('frequency'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('frequency', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_service_frequency_search', 'id', 'frequency', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contract_duration`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('duration'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('duration', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_contract_duration_search', 'id', 'duration', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`customer_site_quoted`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('site_name', true),
                    new IntegerField('site_id'),
                    new IntegerField('customer_id', true),
                    new StringField('site_code'),
                    new StringField('vat_number'),
                    new StringField('contact_person'),
                    new StringField('email_address'),
                    new StringField('tel_number'),
                    new StringField('cell_number'),
                    new StringField('fax_number'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('site_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_site_quoted_search', 'id', 'site_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_region_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_profit_center_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_quote_profit_center_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service_frequency`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('frequency'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('frequency', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_service_frequency_search', 'id', 'frequency', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contract_duration`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('duration'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('duration', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_contract_duration_search', 'id', 'duration', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`customer_site_quoted`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('site_name', true),
                    new IntegerField('site_id'),
                    new IntegerField('customer_id', true),
                    new StringField('site_code'),
                    new StringField('vat_number'),
                    new StringField('contact_person'),
                    new StringField('email_address'),
                    new StringField('tel_number'),
                    new StringField('cell_number'),
                    new StringField('fax_number'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('site_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_site_quoted_search', 'id', 'site_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_region_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_quote_profit_center_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`service_frequency`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('frequency'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('frequency', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_service_frequency_search', 'id', 'frequency', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contract_duration`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('duration'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('duration', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_contract_duration_search', 'id', 'duration', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`customer_site_quoted`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('site_name', true),
                    new IntegerField('site_id'),
                    new IntegerField('customer_id', true),
                    new StringField('site_code'),
                    new StringField('vat_number'),
                    new StringField('contact_person'),
                    new StringField('email_address'),
                    new StringField('tel_number'),
                    new StringField('cell_number'),
                    new StringField('fax_number'),
                    new DateTimeField('upd_date'),
                    new DateTimeField('create_date')
                )
            );
            $lookupDataset->setOrderByField('site_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_site_quoted_search', 'id', 'site_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_region_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_district`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('DistrictName'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('DistrictName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_sales_district_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_quote_profit_center_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class profit_centerPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Profit Center');
            $this->SetMenuLabel('Profit Center');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`profit_center`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_office'),
                    new IntegerField('sales_org'),
                    new IntegerField('sales_division'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $this->dataset->AddLookupField('sales_office', 'region', new IntegerField('Id'), new StringField('RegionName', false, false, false, false, 'sales_office_RegionName', 'sales_office_RegionName_region'), 'sales_office_RegionName_region');
            $this->dataset->AddLookupField('sales_org', 'sales_org', new IntegerField('Id'), new StringField('name', false, false, false, false, 'sales_org_name', 'sales_org_name_sales_org'), 'sales_org_name_sales_org');
            $this->dataset->AddLookupField('sales_division', 'sales_division', new IntegerField('Id'), new StringField('name', false, false, false, false, 'sales_division_name', 'sales_division_name_sales_division'), 'sales_division_name_sales_division');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'Id', 'Id', 'Id'),
                new FilterColumn($this->dataset, 'name', 'name', 'Name'),
                new FilterColumn($this->dataset, 'description', 'description', 'Description'),
                new FilterColumn($this->dataset, 'sales_office', 'sales_office_RegionName', 'Sales Office'),
                new FilterColumn($this->dataset, 'sales_org', 'sales_org_name', 'Sales Org'),
                new FilterColumn($this->dataset, 'sales_division', 'sales_division_name', 'Sales Division'),
                new FilterColumn($this->dataset, 'is_active', 'is_active', 'Is Active'),
                new FilterColumn($this->dataset, 'create_date', 'create_date', 'Create Date')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id'])
                ->addColumn($columns['name'])
                ->addColumn($columns['description'])
                ->addColumn($columns['sales_office'])
                ->addColumn($columns['sales_org'])
                ->addColumn($columns['sales_division'])
                ->addColumn($columns['is_active'])
                ->addColumn($columns['create_date']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('sales_office')
                ->setOptionsFor('sales_org')
                ->setOptionsFor('sales_division')
                ->setOptionsFor('is_active')
                ->setOptionsFor('create_date');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['Id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name');
            
            $filterBuilder->addColumn(
                $columns['name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('description');
            
            $filterBuilder->addColumn(
                $columns['description'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('sales_office_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_sales_office_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('sales_office', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_sales_office_search');
            
            $text_editor = new TextEdit('sales_office');
            
            $filterBuilder->addColumn(
                $columns['sales_office'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_sales_org_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('sales_org', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_sales_org_search');
            
            $text_editor = new TextEdit('sales_org');
            
            $filterBuilder->addColumn(
                $columns['sales_org'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_profit_center_sales_division_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('sales_division', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_profit_center_sales_division_search');
            
            $text_editor = new TextEdit('sales_division');
            
            $filterBuilder->addColumn(
                $columns['sales_division'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('is_active');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['is_active'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['create_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            if (GetCurrentUserPermissionsForPage('profit_center.quote')->HasViewGrant() && $withDetails)
            {
            //
            // View column for profit_center_quote detail
            //
            $column = new DetailColumn(array('Id'), 'profit_center.quote', 'profit_center_quote_handler', $this->dataset, 'Quote');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for Id field
            //
            $column = new NumberViewColumn('Id', 'Id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('sales_office', 'sales_office_RegionName', 'Sales Office', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for is_active field
            //
            $column = new CheckboxViewColumn('is_active', 'is_active', 'Is Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Id field
            //
            $column = new NumberViewColumn('Id', 'Id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('sales_office', 'sales_office_RegionName', 'Sales Office', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for is_active field
            //
            $column = new CheckboxViewColumn('is_active', 'is_active', 'Is Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextAreaEdit('name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_office field
            //
            $editor = new DynamicCombobox('sales_office_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Office', 'sales_office', 'sales_office_RegionName', 'edit_profit_center_sales_office_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_org field
            //
            $editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Org', 'sales_org', 'sales_org_name', 'edit_profit_center_sales_org_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sales_division field
            //
            $editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Division', 'sales_division', 'sales_division_name', 'edit_profit_center_sales_division_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for is_active field
            //
            $editor = new CheckBox('is_active_edit');
            $editColumn = new CustomEditColumn('Is Active', 'is_active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for create_date field
            //
            $editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Create Date', 'create_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextAreaEdit('name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_office field
            //
            $editor = new DynamicCombobox('sales_office_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Office', 'sales_office', 'sales_office_RegionName', 'multi_edit_profit_center_sales_office_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_org field
            //
            $editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Org', 'sales_org', 'sales_org_name', 'multi_edit_profit_center_sales_org_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sales_division field
            //
            $editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Division', 'sales_division', 'sales_division_name', 'multi_edit_profit_center_sales_division_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for is_active field
            //
            $editor = new CheckBox('is_active_edit');
            $editColumn = new CustomEditColumn('Is Active', 'is_active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for create_date field
            //
            $editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Create Date', 'create_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextAreaEdit('name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_office field
            //
            $editor = new DynamicCombobox('sales_office_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Office', 'sales_office', 'sales_office_RegionName', 'insert_profit_center_sales_office_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_org field
            //
            $editor = new DynamicCombobox('sales_org_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Org', 'sales_org', 'sales_org_name', 'insert_profit_center_sales_org_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sales_division field
            //
            $editor = new DynamicCombobox('sales_division_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Sales Division', 'sales_division', 'sales_division_name', 'insert_profit_center_sales_division_search', $editor, $this->dataset, $lookupDataset, 'Id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for is_active field
            //
            $editor = new CheckBox('is_active_edit');
            $editColumn = new CustomEditColumn('Is Active', 'is_active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for create_date field
            //
            $editor = new DateTimeEdit('create_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Create Date', 'create_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for Id field
            //
            $column = new NumberViewColumn('Id', 'Id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('sales_office', 'sales_office_RegionName', 'Sales Office', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for is_active field
            //
            $column = new CheckboxViewColumn('is_active', 'is_active', 'Is Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Id field
            //
            $column = new NumberViewColumn('Id', 'Id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('sales_office', 'sales_office_RegionName', 'Sales Office', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for is_active field
            //
            $column = new CheckboxViewColumn('is_active', 'is_active', 'Is Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('sales_office', 'sales_office_RegionName', 'Sales Office', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_org', 'sales_org_name', 'Sales Org', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('sales_division', 'sales_division_name', 'Sales Division', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for is_active field
            //
            $column = new CheckboxViewColumn('is_active', 'is_active', 'Is Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for create_date field
            //
            $column = new DateTimeViewColumn('create_date', 'create_date', 'Create Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $detailPage = new profit_center_quotePage('profit_center_quote', $this, array('profit_center'), array('Id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('profit_center.quote'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('profit_center.quote'));
            $detailPage->SetHttpHandlerName('profit_center_quote_handler');
            $handler = new PageHTTPHandler('profit_center_quote_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_sales_office_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_profit_center_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_sales_office_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_profit_center_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_sales_office_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_profit_center_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`region`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RegionName'),
                    new StringField('Description'),
                    new StringField('Address'),
                    new StringField('PostalAddress'),
                    new StringField('TelNum'),
                    new StringField('Email'),
                    new StringField('Website'),
                    new DateTimeField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RegionName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_sales_office_search', 'Id', 'RegionName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_org`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_sales_org_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`sales_division`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new StringField('description'),
                    new IntegerField('sales_org'),
                    new BooleanField('is_active'),
                    new DateField('create_date')
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_profit_center_sales_division_search', 'Id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new profit_centerPage("profit_center", "profit_center.php", GetCurrentUserPermissionsForPage("profit_center"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("profit_center"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
