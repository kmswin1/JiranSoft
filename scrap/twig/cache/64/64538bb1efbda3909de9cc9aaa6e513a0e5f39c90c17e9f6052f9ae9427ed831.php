<?php

/* scrapList.twig */
class __TwigTemplate_745c933a3db4b75162d0f6115c96e85c12d11ac00deaa1d64d57df64314f0291 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset=\"utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no\" />
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css\" />
    <style type=\"text/css\">
        body {padding:10px;}
        .meta .ui.label {margin-top:5px;}
        #float_button {
            position: fixed;
            left:10px;
            bottom: 50px;
            z-index: 1000;
        }
    </style>
</head>
<body>
<div class=\"ui container\">
<!--
<?php
    if (isset(\$curBook)) {
?>
    <h2 class=\"ui header\">현재 추가된 항목</h2>
    <div class=\"ui two stackable cards\">
        <div class=\"card\">
            <div class=\"image\">
                <img src=\"https://platform.ondana.jp/resources/thumbnails/cover_<?php echo \$curBook['THUMBNAIL_FILEID']?>.jpg\" >
            </div>
            <div class=\"content\">
                <div class=\"header\"><?php echo \$curBook['TITLE']?></div>
                <div class=\"description\">
                    <?php echo \$curBook['SUMMARY']?>
                </div>
                <div class=\"meta\">
                    <?php
                        foreach (\$tags as \$key => \$value) {
                            echo \"<div class='ui label'>{\$value}</div>\";
                        }
                    ?>
                </div>
            </div>
            <div class=\"extra content\">
                <span class=\"right floated\">
                    <?php echo date('Y-m-d H:i:s',\$curBook['added_time'])?>
                </span>
                <span>
                    <i class=\"user icon\"></i>
                    75명이 함께함
                </span>
            </div>
        </div>
    </div>

    <div class=\"ui divider\"></div>
<?php
    }
?>
-->
    <h2 class=\"ui header\">Recents</h2>
    <div id=\"lists\" class=\"ui three stackable cards\">
";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["scrapList"]) ? $context["scrapList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["book"]) {
            // line 64
            echo "        <div id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["book"], "item", array()), "OBJID", array()), "html", null, true);
            echo "\" class=\"card\">
            <div class=\"image\">
                <img src=\"https://platform.ondana.jp/resources/thumbnails/cover_<?php echo \$book['THUMBNAIL_FILEID']?>.jpg\" border=\"1\" />
            </div>
            <div class=\"content desc\">
                <a class=\"header\">";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["book"], "item", array()), "TITLE", array()), "html", null, true);
            echo "</a>
                <div class=\"description\">
                    ";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["book"], "item", array()), "SUMMARY", array()), "html", null, true);
            echo "
                </div>
                <div class=\"meta\">
                    <% for tag in book.item.TAGS %>
                        <div class='ui label'>";
            // line 75
            echo twig_escape_filter($this->env, (isset($context["tag"]) ? $context["tag"] : null), "html", null, true);
            echo "</div>\";
                    <% endfor %>
                </div>
            </div>
            <div class=\"extra content\">
                <span class=\"right floated\">
                    ";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute($context["book"], "readded_at", array()), "html", null, true);
            echo "
                </span>
                <span>
                    <i class=\"user icon\"></i>
                    
                </span>
            </div>
        </div>
        <div class=\"ui divider\"></div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['book'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 91
        echo "    </div>
</div>
<!--
<div id=\"float_button\" class=\"ui circular icon green floated left pointing dropdown button\">
    <i class=\"vertically flipped large magic icon\"></i>
    <div class=\"menu\">
        <div class=\"header\">
        </div>
        <div class=\"divider\"></div>
        <div class=\"item trusted\" data-value=\"TRUSTED\">
            <i class=\"icon green tags\"></i>
            <span>aaaa</span>
        </div>
        <div class=\"item new\" data-value=\"NEW\">
            <i class=\"icon yellow tags\"></i>
            <span>bbb</span>
        </div>
        <div class=\"item blocked\" data-value=\"THREAT\">
            <i class=\"icon red tags\"></i>
            <span>ccc</span>
        </div>
    </div>
</div>
-->
<script src=\"https://code.jquery.com/jquery-3.3.1.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js\"></script>
<script type=\"text/javascript\">
    var curId = '<?php echo \$curId?>';
    \$(function () {
        \$('.ui.dropdown').dropdown();
        \$('#'+curId).transition('glow','5000ms');
        \$(\"#float_button\").dropdown('setting', 'onChange', function (value, text) {
            // \$(\"#lists\").removeClass(\"stackable\");
        });
    });
</script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "scrapList.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 91,  117 => 81,  108 => 75,  101 => 71,  96 => 69,  87 => 64,  83 => 63,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "scrapList.twig", "/data/ondana/scrap/webdata/twig/templates/scrapList.twig");
    }
}
