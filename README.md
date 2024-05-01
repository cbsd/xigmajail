**Description:**

 This is the XigmaNAS CBSD Extension for quickly create and manage jails.

![image](https://github.com/cbsd/xigmajail/assets/926409/b24ae262-f281-4bf1-94ef-0fa4497ead6a)


**Installation**

1) Install module, XigmaNAS:

*Tools > Command > Command* (paste line):
```
fetch --no-verify-peer https://raw.githubusercontent.com/cbsd/xigmajail/main/utils/cbsdjail_install.sh  && chmod +x cbsdjail_install.sh && ./cbsdjail_install.sh && echo "=> Done!"
```

2) Make sure the 'Disable Extension Menu' checkbox is unset, XigmaNAS UI:

System > Advanced Setup -> Disable Extension Menu [ ] Disable scanning of folders for existing extension menus.

3) Initialize the working directory of the cbsd to any existing pool:

Extensions > CBSD jail


![image](https://github.com/cbsd/xigmajail/assets/926409/7bc1c494-486e-48a6-aea3-4174caa47ec6)


**Errata:**

Creating the first container may take a long time as the module downloads the base.txz ( FreeBSD base tarball ) archive from FreeBSD.org.

**Credits:**

 Oleg Ginzburg (olevole)

Additional information on CBSD: <a href="https://github.com/cbsd/cbsd">https://github.com/cbsd/cbsd</a>
