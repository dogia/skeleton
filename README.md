# Skeleton by Dogia
Skeleton is a very light framework to make REST Full Apis, easy to read and ready to use.


# Router

### Easy to enroute!
```php
$router = new Router();  
$router->append(Request::GET, "/skeleton/prefix-{section}/", [User::class, 'login']);  
$router->attend();
```
- Easy to use prefix in this case prefix- is a real prefix!
- It'll attend for /skeleton/prefix-home and $section will take the value "home"
### How looks the controller?
```php
namespace Skeleton\Api;
use Skeleton\Core\Router\{Response, Request};  
class User  {  
    public function login(Response $response, Request $request, $section)  {  
	  echo "login called at $section";  
    }  
}
```
# You want to develop, Sure !!!
You can fork and make pull requests!
