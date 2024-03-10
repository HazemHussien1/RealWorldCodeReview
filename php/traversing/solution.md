# Solution

The vulnerability is a Path Traversal and it was in OpenCart.

The input is being taken here, the filename is obtained from the incoming HTTP GET request and stored into the $filename PHP variable without any form of input sanitisation.
```
       $filename = (string)$this->request->get['filename'];
```

the file name is appended to the back of the storage log path /system/storage/logs/ and stored into another variable $file.
```
   // DIR_LOGS = /system/storage/logs/
    $file = DIR_LOGS . $filename; // [2]
```

then, the $file variable is used in a fopen() function call with the mode set to w+. This means that the existing file will have its content emptied. Since a file existence check occurs before this, it is not possible to create files that do not already exist.

```
        $handle = fopen($file, 'w+');
```

Here's the original writeup https://starlabs.sg/advisories/23/23-2315/
