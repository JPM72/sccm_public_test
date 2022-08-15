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
    
    
    
    class role_ratePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Role Rate');
            $this->SetMenuLabel('Role Rate');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`role_rate`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('name'),
                    new IntegerField('rate'),
                    new IntegerField('role', true),
                    new IntegerField('Region'),
                    new IntegerField('SalesDistrict'),
                    new DateField('valid_from'),
                    new DateField('valid_till'),
                    new DateField('create_date')
                )
            );
            $this->dataset->AddLookupField('role', '`role`', new IntegerField('Id'), new StringField('RoleName', false, false, false, false, 'role_RoleName', 'role_RoleName_role'), 'role_RoleName_role');
            $this->dataset->AddLookupField('Region', 'region', new IntegerField('Id'), new StringField('RegionName', false, false, false, false, 'Region_RegionName', 'Region_RegionName_region'), 'Region_RegionName_region');
            $this->dataset->AddLookupField('SalesDistrict', 'sales_district', new IntegerField('Id'), new StringField('DistrictName', false, false, false, false, 'SalesDistrict_DistrictName', 'SalesDistrict_DistrictName_sales_district'), 'SalesDistrict_DistrictName_sales_district');
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
                new FilterColumn($this->dataset, 'rate', 'rate', 'Rate'),
                new FilterColumn($this->dataset, 'role', 'role_RoleName', 'Role'),
                new FilterColumn($this->dataset, 'Region', 'Region_RegionName', 'Region'),
                new FilterColumn($this->dataset, 'SalesDistrict', 'SalesDistrict_DistrictName', 'Sales District'),
                new FilterColumn($this->dataset, 'valid_from', 'valid_from', 'Valid From'),
                new FilterColumn($this->dataset, 'valid_till', 'valid_till', 'Valid Till'),
                new FilterColumn($this->dataset, 'create_date', 'create_date', 'Create Date')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id'])
                ->addColumn($columns['name'])
                ->addColumn($columns['rate'])
                ->addColumn($columns['role'])
                ->addColumn($columns['Region'])
                ->addColumn($columns['SalesDistrict'])
                ->addColumn($columns['valid_from'])
                ->addColumn($columns['valid_till'])
                ->addColumn($columns['create_date']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('role')
                ->setOptionsFor('Region')
                ->setOptionsFor('SalesDistrict')
                ->setOptionsFor('valid_from')
                ->setOptionsFor('valid_till')
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
            
            $main_editor = new TextEdit('rate_edit');
            
            $filterBuilder->addColumn(
                $columns['rate'],
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
            
            $main_editor = new DynamicCombobox('role_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_role_rate_role_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('role', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_role_rate_role_search');
            
            $text_editor = new TextEdit('role');
            
            $filterBuilder->addColumn(
                $columns['role'],
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
            $main_editor->SetHandlerName('filter_builder_role_rate_Region_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Region', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_role_rate_Region_search');
            
            $text_editor = new TextEdit('Region');
            
            $filterBuilder->addColumn(
                $columns['Region'],
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
            
            $main_editor = new DynamicCombobox('salesdistrict_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_role_rate_SalesDistrict_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('SalesDistrict', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_role_rate_SalesDistrict_search');
            
            $text_editor = new TextEdit('SalesDistrict');
            
            $filterBuilder->addColumn(
                $columns['SalesDistrict'],
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
            
            $main_editor = new DateTimeEdit('valid_till_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['valid_till'],
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
            // View column for rate field
            //
            $column = new NumberViewColumn('rate', 'rate', 'Rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for RoleName field
            //
            $column = new TextViewColumn('role', 'role_RoleName', 'Role', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('Region', 'Region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('SalesDistrict', 'SalesDistrict_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            // View column for valid_till field
            //
            $column = new DateTimeViewColumn('valid_till', 'valid_till', 'Valid Till', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // View column for rate field
            //
            $column = new NumberViewColumn('rate', 'rate', 'Rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for RoleName field
            //
            $column = new TextViewColumn('role', 'role_RoleName', 'Role', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('Region', 'Region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('SalesDistrict', 'SalesDistrict_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for valid_till field
            //
            $column = new DateTimeViewColumn('valid_till', 'valid_till', 'Valid Till', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // Edit column for rate field
            //
            $editor = new TextEdit('rate_edit');
            $editColumn = new CustomEditColumn('Rate', 'rate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for role field
            //
            $editor = new DynamicCombobox('role_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`role`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RoleName'),
                    new DateField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RoleName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Role', 'role', 'role_RoleName', 'edit_role_rate_role_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RoleName', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Region field
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
            $editColumn = new DynamicLookupEditColumn('Region', 'Region', 'Region_RegionName', 'edit_role_rate_Region_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for SalesDistrict field
            //
            $editor = new DynamicCombobox('salesdistrict_edit', $this->CreateLinkBuilder());
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
            $editColumn = new DynamicLookupEditColumn('Sales District', 'SalesDistrict', 'SalesDistrict_DistrictName', 'edit_role_rate_SalesDistrict_search', $editor, $this->dataset, $lookupDataset, 'Id', 'DistrictName', '');
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
            // Edit column for valid_till field
            //
            $editor = new DateTimeEdit('valid_till_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Valid Till', 'valid_till', $editor, $this->dataset);
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
            // Edit column for rate field
            //
            $editor = new TextEdit('rate_edit');
            $editColumn = new CustomEditColumn('Rate', 'rate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for role field
            //
            $editor = new DynamicCombobox('role_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`role`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RoleName'),
                    new DateField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RoleName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Role', 'role', 'role_RoleName', 'multi_edit_role_rate_role_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RoleName', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Region field
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
            $editColumn = new DynamicLookupEditColumn('Region', 'Region', 'Region_RegionName', 'multi_edit_role_rate_Region_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for SalesDistrict field
            //
            $editor = new DynamicCombobox('salesdistrict_edit', $this->CreateLinkBuilder());
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
            $editColumn = new DynamicLookupEditColumn('Sales District', 'SalesDistrict', 'SalesDistrict_DistrictName', 'multi_edit_role_rate_SalesDistrict_search', $editor, $this->dataset, $lookupDataset, 'Id', 'DistrictName', '');
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
            // Edit column for valid_till field
            //
            $editor = new DateTimeEdit('valid_till_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Valid Till', 'valid_till', $editor, $this->dataset);
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
            // Edit column for rate field
            //
            $editor = new TextEdit('rate_edit');
            $editColumn = new CustomEditColumn('Rate', 'rate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for role field
            //
            $editor = new DynamicCombobox('role_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`role`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RoleName'),
                    new DateField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RoleName', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Role', 'role', 'role_RoleName', 'insert_role_rate_role_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RoleName', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Region field
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
            $editColumn = new DynamicLookupEditColumn('Region', 'Region', 'Region_RegionName', 'insert_role_rate_Region_search', $editor, $this->dataset, $lookupDataset, 'Id', 'RegionName', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for SalesDistrict field
            //
            $editor = new DynamicCombobox('salesdistrict_edit', $this->CreateLinkBuilder());
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
            $editColumn = new DynamicLookupEditColumn('Sales District', 'SalesDistrict', 'SalesDistrict_DistrictName', 'insert_role_rate_SalesDistrict_search', $editor, $this->dataset, $lookupDataset, 'Id', 'DistrictName', '');
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
            // Edit column for valid_till field
            //
            $editor = new DateTimeEdit('valid_till_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Valid Till', 'valid_till', $editor, $this->dataset);
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
            // View column for rate field
            //
            $column = new NumberViewColumn('rate', 'rate', 'Rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for RoleName field
            //
            $column = new TextViewColumn('role', 'role_RoleName', 'Role', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('Region', 'Region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('SalesDistrict', 'SalesDistrict_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for valid_till field
            //
            $column = new DateTimeViewColumn('valid_till', 'valid_till', 'Valid Till', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // View column for rate field
            //
            $column = new NumberViewColumn('rate', 'rate', 'Rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for RoleName field
            //
            $column = new TextViewColumn('role', 'role_RoleName', 'Role', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('Region', 'Region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('SalesDistrict', 'SalesDistrict_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for valid_till field
            //
            $column = new DateTimeViewColumn('valid_till', 'valid_till', 'Valid Till', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // View column for rate field
            //
            $column = new NumberViewColumn('rate', 'rate', 'Rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for RoleName field
            //
            $column = new TextViewColumn('role', 'role_RoleName', 'Role', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for RegionName field
            //
            $column = new TextViewColumn('Region', 'Region_RegionName', 'Region', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for DistrictName field
            //
            $column = new TextViewColumn('SalesDistrict', 'SalesDistrict_DistrictName', 'Sales District', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for valid_from field
            //
            $column = new DateTimeViewColumn('valid_from', 'valid_from', 'Valid From', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for valid_till field
            //
            $column = new DateTimeViewColumn('valid_till', 'valid_till', 'Valid Till', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
                '`role`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RoleName'),
                    new DateField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RoleName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_role_rate_role_search', 'Id', 'RoleName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_role_rate_Region_search', 'Id', 'RegionName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_role_rate_SalesDistrict_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`role`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RoleName'),
                    new DateField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RoleName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_role_rate_role_search', 'Id', 'RoleName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_role_rate_Region_search', 'Id', 'RegionName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_role_rate_SalesDistrict_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`role`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RoleName'),
                    new DateField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RoleName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_role_rate_role_search', 'Id', 'RoleName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_role_rate_Region_search', 'Id', 'RegionName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_role_rate_SalesDistrict_search', 'Id', 'DistrictName', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`role`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id', true, true, true),
                    new StringField('RoleName'),
                    new DateField('CreateDate')
                )
            );
            $lookupDataset->setOrderByField('RoleName', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_role_rate_role_search', 'Id', 'RoleName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_role_rate_Region_search', 'Id', 'RegionName', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_role_rate_SalesDistrict_search', 'Id', 'DistrictName', null, 20);
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
        $Page = new role_ratePage("role_rate", "role_rate.php", GetCurrentUserPermissionsForPage("role_rate"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("role_rate"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
