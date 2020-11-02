<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* database/designer/schema_export.twig */
class __TwigTemplate_13700351c962c99cc8606495d7d85e302c4e45b5bba0d2d0b9d194214e0dcaae extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<form method=\"post\" action=\"schema_export.php\" class=\"disableAjax\" id=\"id_export_pages\">
    <fieldset>
        ";
        // line 3
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
        <label>";
        // line 4
        echo _gettext("Select Export Relational Type");
        echo "</label>
        ";
        // line 5
        echo PhpMyAdmin\Plugins::getChoice("Schema", "export_type", ($context["export_list"] ?? null), "format");
        echo "
        <input type=\"hidden\" name=\"page_number\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["page"] ?? null), "html", null, true);
        echo "\">
        ";
        // line 7
        echo PhpMyAdmin\Plugins::getOptions("Schema", ($context["export_list"] ?? null));
        echo "
    </fieldset>
</form>
";
    }

    public function getTemplateName()
    {
        return "database/designer/schema_export.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 7,  53 => 6,  49 => 5,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/designer/schema_export.twig", "C:\\xampp\\phpMyAdmin\\templates\\database\\designer\\schema_export.twig");
    }
}
