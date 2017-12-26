# Random-Fetcher
Random-Fetcher helps to fetch random data based on url . Data can be infomat of JSON/XML/TEXT

## Examples

``` 
fetch.php?type=json&repeat=4&variable=name&name=s2mn3mx6
```
### Output

[
  {
    "name": "dss zju"
  },
  {
    "name": "beda hrk"
  },
  {
    "name": "laeqfd qzy"
  },
  {
    "name": "ajidh jljx"
  }
]


## Explaination


type could be xml/json/text

repeat for fixed value is like ```repeat=20```  20 item will be written and for variable is like ``` repeat=20_40 ``` repeat would be in between 20 to 40

variable is for items in json/xml like ```variable=name``` and ```name=s2mn3mx6``` define type of value s for string 2 for 2 string mn for minimum number of character in string mx for maximum number of character

s for string

n for number 

i for object

a for array
 
