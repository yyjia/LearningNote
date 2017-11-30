### Oauth2.0介绍

 [参考阮一峰大神的解释](http://www.ruanyifeng.com/blog/2014/05/oauth_2_0.html) 本次仅做总结

1. 用户打开客户端以后，客户端要求用户给予授权。

2. 用户同意给予客户端授权。

3. 客户端使用上一步获得的授权，向认证服务器申请令牌。

4. 认证服务器对客户端进行认证以后，确认无误，同意发放令牌。

5. 客户端使用令牌，向资源服务器申请获取资源。

6. 资源服务器确认令牌无误，同意向客户端开放资源。

### 客户端的授权模式

- 授权码模式

>    （A）用户访问客户端，后者将前者导向认证服务器。
>
>    （B）用户选择是否给予客户端授权。
>
>    （C）假设用户给予授权，认证服务器将用户导向客户端事先指定的"重定向URI"（redirection URI），同时附上一个授权码。
>
>    （D）客户端收到授权码，附上早先的"重定向URI"，向认证服务器申请令牌。这一步是在客户端的后台的服务器上完成的，对用户不可见。
>
>    （E）认证服务器核对了授权码和重定向URI，确认无误后，向客户端发送访问令牌（access token）和更新令牌（refresh token）。

- 简化模式

  不通过第三方应用程序的服务器，直接在浏览器中向认证服务器申请令牌，跳过了"授权码"这个步骤，因此得名。所有步骤在浏览器中完成，令牌对访问者是可见的，且客户端不需要认证。

>    （A）客户端将用户导向认证服务器。
>
>    （B）用户决定是否给于客户端授权。
>
>    （C）假设用户给予授权，认证服务器将用户导向客户端指定的"重定向URI"，并在URI的Hash部分包含了访问令牌。
>
>    （D）浏览器向资源服务器发出请求，其中不包括上一步收到的Hash值。
>
>    （E）资源服务器返回一个网页，其中包含的代码可以获取Hash值中的令牌。
>
>    （F）浏览器执行上一步获得的脚本，提取出令牌。
>
>    （G）浏览器将令牌发给客户端。
  
- 密码模式

  用户向客户端提供自己的用户名和密码。客户端使用这些信息，向"服务商提供商"索要授权
  一般客户端不会保存用户的信息，用户对客户端高度信任。

>    （A）用户向客户端提供用户名和密码。
>
>    （B）客户端将用户名和密码发给认证服务器，向后者请求令牌。
>
>    （C）认证服务器确认无误后，向客户端提供访问令牌。

- 客户端模式

 指客户端以自己的名义，而不是以用户的名义，向"服务提供商"进行认证。严格地说，客户端模式并不属于OAuth框架所要解决的问题。在这种模式中，用户直接向客户端注册，客户端以自己的名义要求"服务提供商"提供服务，其实不存在授权问题。

>    （A）客户端向认证服务器进行身份认证，并要求一个访问令牌。
>
>    （B）认证服务器确认无误后，向客户端提供访问令牌。

	
