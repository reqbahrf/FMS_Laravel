import globals from "globals";
import pluginJs from "@eslint/js";


export default [
  {languageOptions:
    { globals: globals.browser }
},
{
    "extents": "jquery",
},
  pluginJs.configs.recommended,
];

