#TW-Yii2-Rest

Forked and modified from HarryZheng0907's [yii-rest](https://github.com/HarryZheng0907/yii2-rest).

This package adds some practical search options for your Yii2 ActiveControler's index action.

## Functionality

1. Search capability
```
http://url/users?id=1&username=LIKE_dmi&created_at=MAX_1398153715&addresses.city=南京
```
2. Multi-level expanding of relations
```
http://url/users?expand=addresses,friends.addresses&expand-fields=addresses.phone,friends.addresses
```
3. Sorting by child relation
```
http://url/users?sort=addresses.phone DESC,id ASC
```


## Installation

```
php composer.phar require taktwerk/tw-yii2-rest
```

## Usage

### IndexAction
Change the IndexAction of your Active Controlers to point to `taktwerk\rest\IndexAction`
   
## Examples
```
EQUAL:http://url/users?username=EQUAL_a  // username = 'a'
NOTEQUAL:http://url/users?username=NOTEQUAL_a  // username != 'a'
NULL:http://url/users?username=NULL_  // username IS NULL
LIKE:http://url/users?username=LIKE_a  //username LIKE '%a%'
LLIKE:http://url/users?username=LLIKE_a  //username LIKE '%a'
RLIKE:http://url/users?username=RLIKE_a  //username LIKE 'a%'
IN:http://url/users?username=IN_a,b,c  //username IN ('a','b','c')
NOTIN:http://url/users?username=NOTIN_a,b,c  //username NOT IN ('a','b','c')
MIN:http://url/users?age_min=MIN_10  // age >= 10
MAX:http://url/users?age_max=Max_60  //age <= 60
RANGE:http://url/users?birthdate=RANGE_2015-03  //birthdate<=2015-03-31 AND birthdate >= 2015-03-01
```
