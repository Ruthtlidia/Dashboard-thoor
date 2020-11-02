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

/* database/designer/page_save_as.twig */
class __TwigTemplate_8d093c9fd4cb2edd9b6116e738b70c6a0c29eda193fb3ac52c6cd8004086aefc extends \Twig\Template
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
        echo "<form action=\"db_designer.php\" method=\"post\" name=\"save_as_pages\" id=\"save_as_pages\" class=\"ajax\">
    ";
        // line 2
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
    <fieldset id=\"page_save_as_options\">
        <table>
            <tbody>
                <tr>
                    <td>
                        <input type=\"hidden\" name=\"operation\" value=\"savePage\">
                        ";
        // line 9
        $this->loadTemplate("database/designer/page_selector.twig", "database/designer/page_save_as.twig", 9)->display(twig_to_array(["pdfwork" =>         // line 10
($context["pdfwork"] ?? null), "pages" =>         // line 11
($context["pages"] ?? null)]));
        // line 13
        echo "                    </td>
                </tr>
                <tr>
                    <td>
                        ";
        // line 17
        echo PhpMyAdmin\Util::getRadioFields("save_page", ["same" => _gettext("Save to selected page"), "new" => _gettext("Create a page and save to it")], "same", true);
        // line 25
        echo "
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=\"selected_value\">";
        // line 30
        echo _gettext("New page name");
        echo "</label>
                        <input type=\"text\" name=\"selected_value\" id=\"selected_value\">
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form>
";
    }

    public function getTemplateName()
    {
        return "database/designer/page_save_as.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 30,  62 => 25,  60 => 17,  54 => 13,  52 => 11,  51 => 10,  50 => 9,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/designer/page_save_as.twig", "C:\\xampp\\phpMyAdmin\\templates\\database\\designer\\page_save_as.twig");
    }
}
