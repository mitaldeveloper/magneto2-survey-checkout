# Customer Survey or Review module for Magento 2

The module for take a survey from the customer for from where they come on your site or heared of your site. Added extra "other" option where they can write their reference.


![Demo Customer Survey or Review module](https://github.com/mitaldeveloper/magneto2-survey-checkout/blob/master/Survey/survey-frontend.jpg?raw=true)"Demo Customer Survey or Review module")



## Installation

1. Go to Magento 2 root directory

2. Install module:

   ```

- Download [the latest version here](https://github.com/mitaldeveloper/magneto2-survey-review/archive/main.zip) 
- Extract `master.zip` file to `app/code/Mital/Survey` ; You should create a folder path `app/code//Mital/Survey` if not exist.
- Go to Magento root folder and run upgrade command line to install `Mital_Survey`:

```

3. Enter following commands to enable module:

   ```
   php bin/magento module:enable Mital_Survey
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```

## Configuration

1. Enable and configure the Survey module in Magento® Admin under *Stores* >
   *Configuration* > *Mital-Survey* > *Survey*.

    ![Disable/Enable Customer Survey or Review module](https://github.com/mitaldeveloper/magneto2-survey-checkout/blob/master/Survey/survey-admin-setting.png?raw=true)"Disable/Enable and configure Customer Survey or Review module")

