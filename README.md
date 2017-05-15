# SCBCarnivalPPSigns Background
From Microsoft Win10 IOT Digital Signage example, implementation for concession at carnival

This requires the current build of [Windows 10 IOT](https://developer.microsoft.com/en-us/windows/iot/getstarted) as of May 2017 which is 15063. 

It has been tested on a Raspberry Pi 3 (ARM SOC) and an Intel Compute Stick (Intel Atom SOC). Performance seems better on the Intel SOC.

This has two folders, first is IOT which is the Windows 10 IOT solution. The SERVER folder is a website example that the IOT code will load.

# Customization
When customizing, edit the `Assets/config.xml` and you can place in what assets and their duration. For example to run an arbitray image, place the image in the Assets folder and the XML would look like:

`<file path="Assets\Screens\Oyster_special.png" duration="15"/>`

To load a webpage, it would look like:

`<file type="webpage" path="http://scbcarnival.com/5050" duration="20"/>`

And the duration is how long to display in seconds.

# Deploying
You can load the solution in Visual Studio and deploy to Remote machine (the IOT device). 

Additionally, you can right click on the solution and go to Store, Create App Pakages to build the APPX package. A sample is in the release.

The APPX package can be deployed via the webpage (http://IOTHOST:8080) and upload the APPXBundle package and Dependencies.

After deployed, you need to set the app to be default for startup.
