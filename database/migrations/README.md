# Database Migrations Documentation

## Overview
This directory contains all database migration files for the Quantum Forge Website project. Migrations are organized chronologically and functionally to maintain a clear database schema evolution.

## Current Migration Structure

### Core System Migrations (0001_01_01_xxxxxx)
These are Laravel's default system migrations:
- `0001_01_01_000000_create_users_table.php` - User authentication table
- `0001_01_01_000001_create_cache_table.php` - Cache storage table
- `0001_01_01_000002_create_jobs_table.php` - Queue jobs table

### Portfolio Management System (2025_10_23 - 2025_10_27)
Migrations related to portfolio and project management:
- `2025_10_23_045243_create_portfolios_table.php` - Main portfolios table
- `2025_10_26_143019_create_categories_table.php` - Portfolio categories
- `2025_10_26_143048_add_category_id_to_portfolios_table.php` - Category relationship
- `2025_10_26_150500_remove_category_column_from_portfolios_table.php` - Schema cleanup
- `2025_10_27_000000_create_visits_table.php` - Portfolio visit tracking

### API Enhancement (2024_12_01)
- `2024_12_01_000002_add_api_columns_to_portfolios_table.php` - API management columns

### Activity Logging System (2025_11_12)
- `2025_11_12_091351_create_activity_log_table.php` - Activity logging base
- `2025_11_12_091352_add_event_column_to_activity_log_table.php` - Event tracking
- `2025_11_12_091353_add_batch_uuid_column_to_activity_log_table.php` - Batch operations

## Migration Naming Conventions

### File Naming Format
```
YYYY_MM_DD_HHMMSS_descriptive_name_in_snake_case.php
```

### Examples of Good Naming:
- ✅ `2025_10_23_045243_create_portfolios_table.php`
- ✅ `2025_10_26_143048_add_category_id_to_portfolios_table.php`
- ✅ `2025_11_12_091353_add_batch_uuid_column_to_activity_log_table.php`

### Examples of Poor Naming:
- ❌ `migration1.php` (No timestamp or description)
- ❌ `add_column.php` (No table reference or timestamp)
- ❌ `2025_portfolio.php` (Incomplete timestamp)

## Migration Categories

### 1. Table Creation
Format: `YYYY_MM_DD_HHMMSS_create_[table_name]_table.php`
Purpose: Create new database tables with initial schema.

### 2. Column Addition
Format: `YYYY_MM_DD_HHMMSS_add_[column_name]_to_[table_name]_table.php`
Purpose: Add new columns to existing tables.

### 3. Column Modification
Format: `YYYY_MM_DD_HHMMSS_modify_[column_name]_in_[table_name]_table.php`
Purpose: Change existing column properties.

### 4. Column Removal
Format: `YYYY_MM_DD_HHMMSS_remove_[column_name]_from_[table_name]_table.php`
Purpose: Remove columns from existing tables.

### 5. Index Operations
Format: `YYYY_MM_DD_HHMMSS_add_[index_name]_index_to_[table_name]_table.php`
Purpose: Add or remove database indexes.

### 6. Foreign Key Operations
Format: `YYYY_MM_DD_HHMMSS_add_[foreign_key_name]_foreign_key_to_[table_name]_table.php`
Purpose: Establish relationships between tables.

## Best Practices

### 1. Chronological Order
- Always use current timestamp for new migrations
- Laravel will run migrations in chronological order
- Never modify existing migration timestamps

### 2. Functional Grouping
- Keep related migrations close in time (same day if possible)
- Use descriptive names that indicate purpose
- Group schema changes for the same feature together

### 3. Code Consistency
- Use Laravel's Schema builder consistently
- Include proper up() and down() methods
- Add comments for complex operations
- Check for table/column existence before operations

### 4. Safety Checks
- Always check if tables/columns exist before creating
- Use proper data types and constraints
- Include rollback logic in down() methods
- Test migrations on development database first

## Migration Workflow

### Creating New Migrations
```bash
php artisan make:migration create_example_table
```

### Running Migrations
```bash
php artisan migrate
```

### Rolling Back
```bash
php artisan migrate:rollback
```

### Fresh Migration
```bash
php artisan migrate:fresh
```

## Schema Evolution Pattern

The current migrations follow this evolution pattern:

1. **Base Tables**: Core system tables (users, cache, jobs)
2. **Feature Tables**: Portfolio management system
3. **Enhancements**: API columns and additional features
4. **Optimization**: Indexes and performance improvements
5. **Logging**: Activity tracking and audit trails

## Common Issues and Solutions

### Issue: Duplicate Migration Timestamps
**Solution**: Always use unique timestamps, check existing files first

### Issue: Missing Rollback Logic
**Solution**: Always implement proper down() method

### Issue: Breaking Changes
**Solution**: Create new migrations instead of modifying old ones

### Issue: Performance Impact
**Solution**: Add indexes for frequently queried columns

## Development Guidelines

1. **Plan Before Implementing**: Design your schema changes before writing migrations
2. **Test Thoroughly**: Test migrations on development data
3. **Document Changes**: Update this README when adding new migrations
4. **Review Carefully**: Have team members review migration logic
5. **Backup Database**: Always backup before running migrations on production

## Migration Dependencies

Current migration dependencies:
```
portfolios_table -> categories_table (foreign key)
visits_table -> portfolios_table (foreign key)
activity_log_table -> users_table (optional relationship)
```

## Future Considerations

- Consider implementing migration grouping by feature
- Add migration testing framework
- Implement database seeding for development
- Consider using migration squashing for large applications

---

*Last Updated: [Current Date]*
*Next Review: [3 months from current date]*