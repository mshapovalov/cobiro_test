# Menu manager

### Mike's comment :)
As usual I started implementation from domain. I implemented Menu Aggregate with all operations described in the task using DDD (Rich model) 
pattern and wrote some unit tests (not all) for this aggregate. And my 4 hours was gone:)
The next step that I planned to implement is the Application layer. I planned to use the CQRS pattern because it is very easy to implement 
a global caching mechanism on Query Bus. And if we will have a lot of items in the menu and recording operations will be slow we can 
very easily make it asynchronous without changes in the Application level code using Command Bus. After that, I planned to connect my 
Domain and Application to Laravel infrastructure. I planned to use Tactician to implement Query and Command Bus or implement it himself 
because it's not complicated patterns. Then I planned to implement \Grifix\Demo\Test\Domain\Menu\MenuInfrastructureInterface::publishEvent 
using Laravel Event Bus. I planned to use Doctrine for the mapping aggregate to the database because it provides better opportunities 
for persistence ignorance than Eloquent. And as the second part, I planned to implement the UI layer using Laravel Router and Controllers.

## Table of Contents
- [Task description](#task-description)
- [Routes](#routes)
- [Bonus points](#bonus-points)


## Task Description

Fork or Download this repository and implement the logic to manage a menu.

A Menu has a depth of **N** and maximum number of items per layer **M**. Consider **N** and **M** to be dynamic for bonus points.

It should be possible to manage the menu by sending API requests. Do not implement a frontend for this task.

Feel free to add comments or considerations when submitting the response at the end of the `README`.


### Example menu

* Home
    * Home sub1
        * Home sub sub
            * [N] 
    * Home sub2
    * [M]
* About
* [M]


## Routes


### `POST /menus`

Create a menu.


#### Input

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


#### Output

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


### `GET /menus/{menu}`

Get the menu.


#### Output

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


### `PUT|PATCH /menus/{menu}`

Update the menu.


#### Input

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


#### Output

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


### `DELETE /menus/{menu}`

Delete the menu.


### `POST /menus/{menu}/items`

Create menu items.


#### Input

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `GET /menus/{menu}/items`

Get all menu items.


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `DELETE /menus/{menu}/items`

Remove all menu items.


### `POST /items`

Create an item.


#### Input

```json
{
    "field": "value"
}
```


#### Output

```json
{
    "field": "value"
}
```


### `GET /items/{item}`

Get the item.


#### Output

```json
{
    "field": "value"
}
```


### `PUT|PATCH /items/{item}`

Update the item.


#### Input

```json
{
    "field": "value"
}
```


#### Output

```json
{
    "field": "value"
}
```


### `DELETE /items/{item}`

Delete the item.


### `POST /items/{item}/children`

Create item's children.


#### Input

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `GET /items/{item}/children`

Get all item's children.


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `DELETE /items/{item}/children`

Remove all children.


### `GET /menus/{menu}/layers/{layer}`

Get all menu items in a layer.


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


### `DELETE /menus/{menu}/layers/{layer}`

Remove a layer and relink `layer + 1` with `layer - 1`, to avoid dangling data.


### `GET /menus/{menu}/depth`


#### Output

Get depth of menu.

```json
{
    "depth": 5
}
```


## Bonus points

* 10 vs 1.000.000 menu items - what would you do differently?
* Write documentation
* Use PhpCS | PhpCsFixer | PhpStan
* Use cache
* Use data structures
* Use docker
