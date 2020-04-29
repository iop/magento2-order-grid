# Magento 2 Module Iop_OrderGrid

## Tested on Version

* Magento 2.3.5-p1
* Magento 2.3.4
* Magento 2.3.1

## Main Functionalities
* Order Grid  UI component customization [added coupon_code, discount_amount columns] 
* Copy [coupon_code, discount_amount] values from sales_order into sales_order_grid table during installation.
* Autocopy [coupon_code, discount_amount] values from sales_order into sales_order_grid table after place new orders.

### Features

* Setup/Update via Setup/Path/Data and Setup/Path/Schema.

## Installation 

#### With Composer
Use the following commands to install this module into Magento 2:

    composer require iop/magento2_order-grid
    bin/magento module:enable Iop_OrderGrid
    bin/magento setup:upgrade
       
#### Manual (without composer)
These are the steps:
* Upload the files into folder `app/code/Iop/OrderGrid` of your site
* Run `php -f bin/magento module:enable Iop_OrderGrid`
* Run `php -f bin/magento setup:upgrade`
* Flush the Magento cache `php -f bin/magento cache:flush`
* Done

## Instruction to uninstall
    bin/magento module:uninstall --non-composer Iop_OrderGrid
 
## Screenshot 
![Order Grid View](https://raw.githubusercontent.com/iop/magento2-order-grid/master/docs/backend_view.png)
 
## Author
Igor Ocheretnyi