# Advox_Order module
Configuration is available via `Stores > Configuration > Advox > Order`. Module is prepared for additional features
related with order extensions.

## Additional information
Module requires PHP 7.4 version.

# Changelog

### 1.0.0
- Created module basic files.
- Added plugin for custom order comment and related queue processor.
- Comment can be edited per store view.
- To handle backend and frontend orders plugin after `\Magento\Sales\Model\Service\OrderService::place` is used.
  Alternatively events like alternative events like `checkout_onepage_controller_success_action`
  could be used aswell (like `checkout_onepage_controller_success_action`) however we want to process frontend/adminhtml
  areas and not process every save change (for example event `sales_order_save_after`). 
    
