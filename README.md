# Dubas UUID field for EspoCRM
![Screenshot of Dubas UUID field for EspoCRM](https://devcrm.it/files/2020-12-13_01-20-31_6df171-uF-779948_65b07ac0379e20.png)
Free extension which will add new field type to your EspoCRM and let you to create new field which will generate UUID for every single record.
Extension created by devcrm.it to EspoCRM. Extension is available for download as an extension to EspoCRM at [https://devcrm.it/uuid](https://devcrm.it/uuid).

Our extension support two versions of UUID. The [first(time-based)](https://uuid.ramsey.dev/en/latest/rfc4122/version1.html) and [fourth(random)](https://uuid.ramsey.dev/en/latest/rfc4122/version4.html). We've integrated [ramsey/uuid composer package](https://github.com/ramsey/uuid) to generate UUID's in proper way.

This repo is for comments only, but we do not give any warranty for the extension or installer. You install this extension on your own responsibility. We do not provide additional free support.

## Requirements
1. EspoCRM in version equal or higher than 6.1.0.
2. PHP 7.3+
3. PHP extension [ext-json](https://www.php.net/manual/en/book.json.php)

### Performance
[ramsey/uuid recommends](https://github.com/ramsey/uuid) installing/enabling the following extensions. While not required, these extensions improve the performance of ramsey/uuid.
- [ext-ctype](https://www.php.net/manual/en/book.ctype.php)
- [ext-gmp](https://www.php.net/manual/en/book.gmp.php)
- [ext-bcmath](https://www.php.net/manual/en/book.bc.php)

## Getting started
1. Open our website [https://devcrm.it/uuid](https://devcrm.it/uuid) and download installer;
2. Login to your EspoCRM as admin;
3. Go to admin section and open extensions page;
4. Choose installer from you computer and start installation process;
5. Go to Entity Manager and choose target entity in which you want to generate UUID's;
6. Create new field with type "DUBAS UUID", choose name of field and type of UUID

## Examples
1. We're using this field to create random string which will be unique in [SalesPack](https://www.espocrm.com/extensions/sales-pack/) extension. Thanks to that our customers can download invoices and we're sure that only authorized users have access to this data.
2. We're using UUID's in our attachments extension. EntryPoint require not only token but also unique UUID and based on that information decide is user should have access to specific attachment.

## Support
This extension is shared without any support. Extension is available as it is.
If you want to order some service, all information about us you can find on our website [https://devcrm.it/](https://devcrm.it/).
