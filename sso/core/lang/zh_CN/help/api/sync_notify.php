<?php
return "<h3>同步概述</h3>
    <p>如果当前应用程序在 SSO 中设置允许同步登录，那么在调用本接口时，系统会通知其他设置了同步登录的应用程序登录，以达到一点登录，所有网站登录的目的。下图是同步流程示意图。</p>
    <p>
        <a href=\"{images}sync_process.jpg\" target=\"_blank\"><img src=\"{images}sync_process.jpg\" class=\"img-responsive thumbnail\"></a>
    </p>

    <p>&nbsp;</p>

    <h3>公共通知参数</h3>

    <p>公共通知参数是指向所有接口发起通知时都传递的参数。系统会在“通知接口 URL”上附加 <code>mod=sync</code> 参数，以便接受通知的系统识别。</p>
    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">公共通知参数</div>
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                        <th class=\"text-nowrap\">名称</th>
                        <th class=\"text-nowrap\">类型</th>
                        <th>描述</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"text-nowrap\">time</td>
                        <td class=\"text-nowrap\">int</td>
                        <td>Unix 时间戳，baigo SSO 允许 +-30 分钟以内的时差，为了防止时区设置不同导致的时差，请开发者将应用的时区设置为为与 baigo SSO 一致，关于时区设置，请查看 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=opt#base\">系统设置</a>。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">signature</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>签名，签名是将通知参数中的所有参数（包括公共通知参数，但不含签名）按照一定规律组合以后生成的，同时系统也会附带签名值，以供验证，详情请查看 <a href=\"{BG_URL_HELP}ctl.php?mod=api&act_get=signature#verify\">签名接口</a>。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <p>&nbsp;</p>
    <div class=\"text-right\">
        <a href=\"#top\">
            <span class=\"glyphicon glyphicon-chevron-up\"></span>
            top
        </a>
    </div>
    <hr>
    <p>&nbsp;</p>

    <a name=\"login_notify\"></a>
    <h3>同步登录通知</h3>

    <p class=\"text-success\">接口说明</p>
    <p>应用调用同步接口以后，接入本系统的应用会根据设置情况，由当前应用直接访问“同步接口 URL”，即通知接口中的 <a href=\"{BG_URL_HELP}ctl.php?mod=api&act_get=sync#jsonp_exp\">调用 URL 示例</a>。</p>

    <p class=\"text-success\">HTTP 请求方式</p>
    <p>GET</p>

    <p class=\"text-success\">通知的验证</p>
    <p>系统在推送通知时，会附带用于验证的数据。其中 APP ID 与 APP KEY 需要解密后才能得到，得到后请与当前应用进行对比验证。</p>

    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">通知参数</div>
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                        <th class=\"text-nowrap\">名称</th>
                        <th class=\"text-nowrap\">类型</th>
                        <th>描述</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"text-nowrap\">act_get</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>通知动作，值为 login。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">code</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>加密字符串，需要解密。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=api&act_get=code#decode\">密文接口</a>。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <p>&nbsp;</p>

    <h4>通知参数示例</h4>
    <p>PHP 通过 <code>print_r(\$_GET);</code>，得到数据后，请验证签名是否正确，然后进行下一步操作。</p>

    <p>
<pre><code class=\"language-php\">array(
    &quot;mod&quot;         =&gt; &quot;sync&quot;, //组件名称
    &quot;act_get&quot;     =&gt; &quot;login&quot;, //通知动作
    &quot;time&quot;        =&gt; 1446527788, //Unix 时间戳
    &quot;signature&quot;   =&gt; &quot;sdfdsfsdrewerwugroe7treie&quot;, //签名
    &quot;code&quot;        =&gt; &quot;CSMEIFh7AHYBOFIlXQwAaQE0UXENawF2WUxXUQNFVD4Ac1R%2BUSUFdQgnBmYMcARbAT5RMlprBjZdJQdvBSRQXgkPBEhYZAAnAXFSdV0mAHMBNVEhDQ4BOVliV2wDbFQhAGtUcFElBSwIdgZ2DHEEYQEiUQxaaAY6XWQHPgUkUD0JegRbWFkATwE3UnVdfwAiASVRIA00ASZZXFdxA2lUbgA0VHBRPQUiCBkGVwxTBDQBHVEpWkMGYF1KBxEFR1A1CRcEU1gzADgBf1J7XXEAdQEjUTYNIwELWXdXbANtVGYADlQ%2BUWgFZwg9Bm0MIAQ%2BAXJRHlpSBgJdNwcYBXxQQglrBE9YSgBIAWhSGV0kAD0BbVFxDX0Bdll2V3YDZVRxAA5UO1F3BSIIbgYhDE8EUAEZUStaSgY5XUIHYAVJUFQJbAR6WEMAVgFpUi9dHQBqAR1Rbg1zASk%3D&quot;, //加密字符串
);</code></pre>
    </p>

    <p>&nbsp;</p>

    <p>
        baigo SSO 所有通知接口均推送加密字符串，真正内容需要调用密文接口进行解密。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=api&act_get=code#decode\">密文接口</a>。“同步接口 URL”接收到通知以后，可以根据实际情况，在本地执行一些必要的程序。最后需要输出回调函数，并将数据通过回调函数的参数传回。
    </p>

    <p>&nbsp;</p>

    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">解密后的结果</div>
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                        <th class=\"text-nowrap\">名称</th>
                        <th class=\"text-nowrap\">Base64</th>
                        <th class=\"text-nowrap\">类型</th>
                        <th>描述</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"text-nowrap\">user_id</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">int</td>
                        <td>用户 ID</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">user_name</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>用户名</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">user_mail</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>用户邮箱</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">app_id</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">int</td>
                        <td>APP ID，后台创建应用时生成的 ID。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=app#show\">应用</a>。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">app_key</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>APP KEY，后台创建应用时生成的 KEY。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=app#show\">应用</a>。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <p>&nbsp;</p>

    <h4>返回结果示例</h4>
    <p>得到结果后，请验证 APP ID 与 APP KEY 是否正确，然后进行下一步动作，如：生成会话，标记用户已登录等。</p>

    <p>
<pre><code class=\"language-javascript\">{
    &quot;user_id&quot;: &quot;MTA=&quot;, //用户 ID
    &quot;user_name&quot;: &quot;Zm9uZQ==&quot;, //用户名
    &quot;app_id&quot;: &quot;MTA=&quot;, //APP ID
    &quot;app_key&quot;: &quot;sdfwerwer&quot;; //APP KEY
}</code></pre>
    </p>

    <p>&nbsp;</p>
    <div class=\"text-right\">
        <a href=\"#top\">
            <span class=\"glyphicon glyphicon-chevron-up\"></span>
            top
        </a>
    </div>
    <hr>
    <p>&nbsp;</p>

    <a name=\"logout_notify\"></a>
    <h3>同步登出通知</h3>

    <p class=\"text-success\">接口说明</p>
    <p>应用调用同步接口以后，将会直接访问“同步接口 URL”。</p>

    <p class=\"text-success\">HTTP 请求方式</p>
    <p>GET</p>

    <p class=\"text-success\">通知的验证</p>
    <p>系统在推送通知时，会附带用于验证的数据。其中 APP ID 与 APP KEY 需要解密后才能得到，得到后请与当前应用进行对比验证。</p>

    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">通知参数</div>
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                        <th class=\"text-nowrap\">名称</th>
                        <th class=\"text-nowrap\">类型</th>
                        <th>描述</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"text-nowrap\">act_get</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>通知动作，值为 logout。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">code</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>加密字符串，需要解密。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=api&act_get=code#decode\">密文接口</a>。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <p>
        baigo SSO 所有通知接口均推送加密字符串，真正内容需要调用密文接口进行解密。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=api&act_get=code#decode\">密文接口</a>。“同步接口 URL”接收到通知以后，可以根据实际情况，在本地执行一些必要的程序。最后需要输出回调函数，并将数据通过回调函数的参数传回。
    </p>

    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">解密后的结果</div>
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                        <th class=\"text-nowrap\">名称</th>
                        <th class=\"text-nowrap\">Base64</th>
                        <th class=\"text-nowrap\">类型</th>
                        <th>描述</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"text-nowrap\">user_id</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">int</td>
                        <td>用户 ID</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">user_name</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>用户名</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">user_mail</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>用户邮箱</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">app_id</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">int</td>
                        <td>APP ID，后台创建应用时生成的 ID。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=app#show\">应用</a>。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">app_key</td>
                        <td class=\"text-nowrap\">true</td>
                        <td class=\"text-nowrap\">string</td>
                        <td>APP KEY，后台创建应用时生成的 KEY。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=app#show\">应用</a>。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>";