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

variable is for value name in json/xml like ```variable=name``` and ```name=s2mn3mx6``` define type of value s for string 2 for 2 string mn for minimum number of character in string mx for maximum number of character

s for string

n for number 

i for object

a for array

multiple variable ```variable=id_post&id=ns&post=s10_25mn3mx6``` object of two values will be return id which is number(n) and will be in sequence(s) other one is post of type string(s) contain 10 to 25 words (10_25) word contain minimum 3 character or maximum 6 (mn3mx6)

### number 
    ```
    variable=id_number_serise&id=n&number=nu&serise=ns
    ```
    
  contain three variable id , number , serise . id is a simple number(n).number is a number in unique(nu) . serise is a number contain number in serise 
 
### string 
    ``` 
    variable=name_post&name=s2mn4mx6&post=s20_30mn4mx6 
    ```
   contain two variable name and post of type string . name contain 2 words minimun 4 character and maximum 6 character.
   post contain 20 to 30 words minimum 4 character and maximum 6 character
       
### object 

  ```
  variable=id_comments&id=n&comments=i_comment&comment=s10_30mn3mx6 
  ```


id is of type number comments is of type object contain comment as a single variable of type string contain 10 to 30 words

### array

 ```
 variable=strings_numbers&strings=a4s2mn4mx6&number=a5_9n 
 ```
 
   contain two variable string and number of type array. name contain array of string contain 5 values (a5) and string(s2mn4mx6)
   number contain array values in between 5 to 9 (a5_9) and number(n)
