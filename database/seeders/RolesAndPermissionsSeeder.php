<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'dashboard_admin',
            'dashboard_orders_admin',
            'dashboard_order_products_admin',
            'dashboard_shipping_cost',
            'dashboard_add_shipping_cost',
            'dashboard_add_shipping_cost_daily',
            'dashboard_update_shipping_cost',
            'dashboard_product_price',
            'dashboard_add_product_price',
            'dashboard_update_product_price',
            'reconciliationreport_monthly',
            'reconciliationreport',
            'recon_WFS_StorageFee',
            'recon_WalmartShippingLabelServiceCharge',
            'recon_WFS_LostInventory',
            'recon_WFS_FoundInventory',
            'recon_WFS_InboundTransportationFee',
            'recon_WFS_RC_InventoryDisposalFee',
            'recon_Deposited_in_HYPERWALLET_account',
            'recon_WFS_Refund',
            'dashboard_monthly_reports',
            'dashboard_inventory',
            'dashboard_wfs_inventory',
            'dashboard_users',
            'dashboard_walmart_items',
            'sales_report_by_state',
            'add_product_to_walmart',
            'dashboard_activity_feed',
            'recon_walmart_product_advertising',
            'inventory_valuation_report',
            'dashboard_add_product_pro',
            'consulty_wfs_reports',
            'consulty_venders',
            'consulty_ship_to_locations',
            'consulty_payment_terms',
            'consulty_ship_via',
            'order_refunds',
            'can_po_delete',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $admin      = Role::firstOrCreate(['name' => 'Admin']);
        $employee   = Role::firstOrCreate(['name' => 'Employee']);

        // Assign all permissions to SuperAdmin
        $superAdmin->syncPermissions(Permission::all());

        // Assign selected permissions to Admin
        $admin->syncPermissions([
            'dashboard_admin',
            'dashboard_orders_admin',
            'dashboard_shipping_cost',
            'dashboard_product_price',
            'dashboard_monthly_reports',
            'dashboard_inventory',
            'dashboard_users',
            'sales_report_by_state',
            'add_product_to_walmart',
            'dashboard_activity_feed',
        ]);

        // Assign limited permissions to Employee
        $employee->syncPermissions([
            'dashboard_inventory',
            'dashboard_order_products_admin',
            'dashboard_add_shipping_cost_daily',
            'dashboard_add_product_price',
        ]);
    }
}
