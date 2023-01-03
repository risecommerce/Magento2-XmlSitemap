##Risecommerce XmlSitemap
##Support: 
version - 2.3.x, 2.4.x

##How to install Extension

1. Download the archive file.
2. Unzip the files
3. Create a folder [Magento_Root]/app/code/Risecommerce/XmlSitemap
4. Drop/move the unzipped files to directory '[Magento_Root]/app/code/Risecommerce/XmlSitemap'

#Enable Extension:
- php bin/magento module:enable Risecommerce_XmlSitemap
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush

#Disable Extension:
- php bin/magento module:disable Risecommerce_XmlSitemap
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush
