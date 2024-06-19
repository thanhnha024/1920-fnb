(()=>{var e,t={3090:(e,t,o)=>{"use strict";o.r(t);var r=o(9196),l=o(444);const n=(0,r.createElement)(l.SVG,{viewBox:"0 0 24 24",version:"1.1",id:"svg713",xmlns:"http://www.w3.org/2000/svg"},(0,r.createElement)("defs",{id:"defs705"}),(0,r.createElement)("path",{id:"path882",d:"m 19.199219,1.4501954 a 3.8,3.8 0 0 0 -3.72461,3.0996093 H 5.1992188 l -0.8984376,-2 H 1 v 2 h 2 l 3.5996094,7.5996093 -1.2988282,2.400391 a 2,2 0 0 0 1.6992188,3 h 12 v -2 H 7 l 1.0996094,-2 h 7.4999996 a 1.9,1.9 0 0 0 1.701172,-1 L 19.240234,9.0458985 A 3.8,3.8 0 0 0 23,5.2490235 3.8,3.8 0 0 0 19.199219,1.4501954 Z M 6.1757812,6.5087891 h 9.4433598 c 0.02007,0.055814 0.0433,0.1034655 0.06445,0.15625 a 3.8,3.8 0 0 0 0.08398,0.2050781 c 0.07333,0.1598062 0.153258,0.3011377 0.236328,0.4335937 0.194879,0.3107365 0.413084,0.5552137 0.646485,0.7578126 a 3.8,3.8 0 0 0 0.324218,0.2558593 3.8,3.8 0 0 0 0.228516,0.1601563 l -1.71093,3.0722659 H 8.5175781 Z M 7,18.549805 a 2,2 0 1 0 2,2 2,2 0 0 0 -2,-2 z m 10,0 a 2,2 0 0 0 -2,2 2,2 0 0 0 2,2 2,2 0 0 0 0.617188,-3.902344 A 2,2 0 0 0 17,18.549805 Z"}));var c=o(1984);const a=window.wp.blocks,i=window.wc.wcSettings;var s,u,d,p,m,g,C,b,w,h;const v=(0,i.getSetting)("wcBlocksConfig",{buildPhase:1,pluginUrl:"",productCount:0,defaultAvatar:"",restApiRoutes:{},wordCountType:"words"}),_=v.pluginUrl+"images/",E=(v.pluginUrl,v.buildPhase),k=(null===(s=i.STORE_PAGES.shop)||void 0===s||s.permalink,null===(u=i.STORE_PAGES.checkout)||void 0===u||u.id,null===(d=i.STORE_PAGES.checkout)||void 0===d||d.permalink,null===(p=i.STORE_PAGES.privacy)||void 0===p||p.permalink,null===(m=i.STORE_PAGES.privacy)||void 0===m||m.title,null===(g=i.STORE_PAGES.terms)||void 0===g||g.permalink,null===(C=i.STORE_PAGES.terms)||void 0===C||C.title,null===(b=i.STORE_PAGES.cart)||void 0===b||b.id,null===(w=i.STORE_PAGES.cart)||void 0===w||w.permalink,null!==(h=i.STORE_PAGES.myaccount)&&void 0!==h&&h.permalink?i.STORE_PAGES.myaccount.permalink:(0,i.getSetting)("wpLoginUrl","/wp-login.php"),(0,i.getSetting)("localPickupEnabled",!1),(0,i.getSetting)("countries",{})),f=(0,i.getSetting)("countryData",{}),y=(Object.fromEntries(Object.keys(f).filter((e=>!0===f[e].allowBilling)).map((e=>[e,k[e]||""]))),Object.fromEntries(Object.keys(f).filter((e=>!0===f[e].allowBilling)).map((e=>[e,f[e].states||[]]))),Object.fromEntries(Object.keys(f).filter((e=>!0===f[e].allowShipping)).map((e=>[e,k[e]||""]))),Object.fromEntries(Object.keys(f).filter((e=>!0===f[e].allowShipping)).map((e=>[e,f[e].states||[]]))),Object.fromEntries(Object.keys(f).map((e=>[e,f[e].locale||[]]))),window.wp.hooks),S=JSON.parse('{"name":"woocommerce/mini-cart","version":"1.0.0","title":"Mini-Cart","icon":"miniCartAlt","description":"Display a button for shoppers to quickly view their cart.","category":"woocommerce","keywords":["WooCommerce"],"textdomain":"woocommerce","supports":{"html":false,"multiple":false,"typography":{"fontSize":true}},"example":{"attributes":{"isPreview":true,"className":"wc-block-mini-cart--preview"}},"attributes":{"isPreview":{"type":"boolean","default":false},"miniCartIcon":{"type":"string","default":"cart"},"addToCartBehaviour":{"type":"string","default":"none"},"hasHiddenPrice":{"type":"boolean","default":false},"cartAndCheckoutRenderStyle":{"type":"string","default":"hidden"},"priceColor":{"type":"object"},"priceColorValue":{"type":"string"},"iconColor":{"type":"object"},"iconColorValue":{"type":"string"},"productCountColor":{"type":"object"},"productCountColorValue":{"type":"string"}},"apiVersion":2,"$schema":"https://schemas.wp.org/trunk/block.json"}'),O=window.wp.blockEditor,T=window.wc.priceFormat,x=window.wp.components;var R=o(5736),P=o(9307),A=o(5904),G=o(4697);const H=["BUTTON","FIELDSET","INPUT","OPTGROUP","OPTION","SELECT","TEXTAREA","A"],V=({children:e,style:t={},...o})=>{const l=(0,P.useRef)(null),n=()=>{l.current&&A.focus.focusable.find(l.current).forEach((e=>{H.includes(e.nodeName)&&e.setAttribute("tabindex","-1"),e.hasAttribute("contenteditable")&&e.setAttribute("contenteditable","false")}))},c=(0,G.y1)(n,0,{leading:!0});return(0,P.useLayoutEffect)((()=>{let e;return n(),l.current&&(e=new window.MutationObserver(c),e.observe(l.current,{childList:!0,attributes:!0,subtree:!0})),()=>{e&&e.disconnect(),c.cancel()}}),[c]),(0,r.createElement)("div",{ref:l,"aria-disabled":"true",style:{userSelect:"none",pointerEvents:"none",cursor:"normal",...t},...o},e)},B=window.wp.data,M=(0,r.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 32 32",fill:"none"},(0,r.createElement)("circle",{cx:"12.6667",cy:"24.6667",r:"2",fill:"currentColor"}),(0,r.createElement)("circle",{cx:"23.3333",cy:"24.6667",r:"2",fill:"currentColor"}),(0,r.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M9.28491 10.0356C9.47481 9.80216 9.75971 9.66667 10.0606 9.66667H25.3333C25.6232 9.66667 25.8989 9.79247 26.0888 10.0115C26.2787 10.2305 26.3643 10.5211 26.3233 10.8081L24.99 20.1414C24.9196 20.6341 24.4977 21 24 21H12C11.5261 21 11.1173 20.6674 11.0209 20.2034L9.08153 10.8701C9.02031 10.5755 9.09501 10.269 9.28491 10.0356ZM11.2898 11.6667L12.8136 19H23.1327L24.1803 11.6667H11.2898Z",fill:"currentColor"}),(0,r.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M5.66669 6.66667C5.66669 6.11438 6.1144 5.66667 6.66669 5.66667H9.33335C9.81664 5.66667 10.2308 6.01229 10.3172 6.48778L11.0445 10.4878C11.1433 11.0312 10.7829 11.5517 10.2395 11.6505C9.69614 11.7493 9.17555 11.3889 9.07676 10.8456L8.49878 7.66667H6.66669C6.1144 7.66667 5.66669 7.21895 5.66669 6.66667Z",fill:"currentColor"})),j=(0,r.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 32 32",fill:"none"},(0,r.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M12.4444 14.2222C12.9354 14.2222 13.3333 14.6202 13.3333 15.1111C13.3333 15.8183 13.6143 16.4966 14.1144 16.9967C14.6145 17.4968 15.2927 17.7778 16 17.7778C16.7072 17.7778 17.3855 17.4968 17.8856 16.9967C18.3857 16.4966 18.6667 15.8183 18.6667 15.1111C18.6667 14.6202 19.0646 14.2222 19.5555 14.2222C20.0465 14.2222 20.4444 14.6202 20.4444 15.1111C20.4444 16.2898 19.9762 17.4203 19.1427 18.2538C18.3092 19.0873 17.1787 19.5555 16 19.5555C14.8212 19.5555 13.6908 19.0873 12.8573 18.2538C12.0238 17.4203 11.5555 16.2898 11.5555 15.1111C11.5555 14.6202 11.9535 14.2222 12.4444 14.2222Z",fill:"currentColor"}),(0,r.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M11.2408 6.68254C11.4307 6.46089 11.7081 6.33333 12 6.33333H20C20.2919 6.33333 20.5693 6.46089 20.7593 6.68254L24.7593 11.3492C25.0134 11.6457 25.0717 12.0631 24.9085 12.4179C24.7453 12.7727 24.3905 13 24 13H8.00001C7.60948 13 7.25469 12.7727 7.0915 12.4179C6.92832 12.0631 6.9866 11.6457 7.24076 11.3492L11.2408 6.68254ZM12.4599 8.33333L10.1742 11H21.8258L19.5401 8.33333H12.4599Z",fill:"currentColor"}),(0,r.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M7 12C7 11.4477 7.44772 11 8 11H24C24.5523 11 25 11.4477 25 12V25.3333C25 25.8856 24.5523 26.3333 24 26.3333H8C7.44772 26.3333 7 25.8856 7 25.3333V12ZM9 13V24.3333H23V13H9Z",fill:"currentColor"})),Z=(0,r.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 32 32",fill:"none"},(0,r.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M19.5556 12.3333C19.0646 12.3333 18.6667 11.9354 18.6667 11.4444C18.6667 10.7372 18.3857 8.05893 17.8856 7.55883C17.3855 7.05873 16.7073 6.77778 16 6.77778C15.2928 6.77778 14.6145 7.05873 14.1144 7.55883C13.6143 8.05893 13.3333 10.7372 13.3333 11.4444C13.3333 11.9354 12.9354 12.3333 12.4445 12.3333C11.9535 12.3333 11.5556 11.9354 11.5556 11.4444C11.5556 10.2657 12.0238 7.13524 12.8573 6.30175C13.6908 5.46825 14.8213 5 16 5C17.1788 5 18.3092 5.46825 19.1427 6.30175C19.9762 7.13524 20.4445 10.2657 20.4445 11.4444C20.4445 11.9354 20.0465 12.3333 19.5556 12.3333Z",fill:"currentColor"}),(0,r.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M7.5 12C7.5 11.4477 7.94772 11 8.5 11H23.5C24.0523 11 24.5 11.4477 24.5 12V25.3333C24.5 25.8856 24.0523 26.3333 23.5 26.3333H8.5C7.94772 26.3333 7.5 25.8856 7.5 25.3333V12ZM9.5 13V24.3333H22.5V13H9.5Z",fill:"currentColor"})),L=({colorTypes:e})=>{const t=(0,O.__experimentalUseMultipleOriginColorsAndGradients)(),o=(e=>{const t=[];return e.colors&&e.colors.forEach((e=>{t.push(...e.colors)})),e.gradients&&e.gradients.forEach((e=>{t.push(...e.gradients)})),t})(t),{clientId:l}=(0,O.useBlockEditContext)(),n=(0,B.useSelect)((e=>{const{getBlockAttributes:t}=e(O.store);return t(l)||{}}),[l]),{updateBlockAttributes:c}=(0,B.useDispatch)(O.store),a=(0,P.useMemo)((()=>((e,t,o,r)=>Object.entries(e).reduce(((e,[l,n])=>{var c,a;const i=((e,t,o,r)=>l=>{const n=((e,t,o)=>{if(!t)return;const r=(null==e?void 0:e.find((e=>e.color===t||e.slug===t)))||{};return null!=r&&r.color||(r.color=t),r.class=(0,O.getColorClassName)(o,null==r?void 0:r.slug),r})(o,l,t)||{};r({[e]:n})})(l,n.context,t,r),s={colorValue:null!==(c=null==o||null===(a=o[l])||void 0===a?void 0:a.color)&&void 0!==c?c:void 0,label:n.label,onColorChange:i,resetAllFilter:()=>i()};return e.push(s),e}),[]))(e,o,n,(e=>c(l,e)))),[e,o,c,n,l]);return t.hasColorsOrGradients&&(0,r.createElement)(O.InspectorControls,{group:"color"},(0,r.createElement)(O.__experimentalColorGradientSettingsDropdown,{__experimentalIsRenderedInSidebar:!0,settings:a,panelId:l,...t}))};o(9794);const N=({count:e,icon:t,iconColor:o,productCountColor:l})=>(0,r.createElement)("span",{className:"wc-block-mini-cart__quantity-badge"},(0,r.createElement)(c.Z,{className:"wc-block-mini-cart__icon",color:o.color,size:20,icon:function(e){switch(e){case"cart":default:return M;case"bag":return j;case"bag-alt":return Z}}(t)}),(0,r.createElement)("span",{className:"wc-block-mini-cart__badge",style:{background:l.color}},e>0?e:"")),I={name:void 0,color:void 0,slug:void 0};window.wp.apiFetch,o(7272);o(5848);const D={...S.supports,...E>1&&{typography:{...S.supports.typography,__experimentalFontFamily:!0,__experimentalFontWeight:!0}}};(0,a.registerBlockType)(S,{icon:{src:(0,r.createElement)(c.Z,{icon:n,className:"wc-block-editor-components-block-icon wc-block-editor-mini-cart__icon"})},supports:{...D},example:{...S.example},attributes:{...S.attributes},edit:({attributes:e,setAttributes:t})=>{const{cartAndCheckoutRenderStyle:o,addToCartBehaviour:l,hasHiddenPrice:n,priceColor:a=I,iconColor:s=I,productCountColor:u=I,miniCartIcon:d}=function(e){const t={...e};return t.priceColorValue&&!t.priceColor&&(t.priceColor={color:e.priceColorValue},delete t.priceColorValue),t.iconColorValue&&!t.iconColor&&(t.iconColor={color:e.iconColorValue},delete t.iconColorValue),t.productCountColorValue&&!t.productCountColor&&(t.productCountColor={color:e.productCountColorValue},delete t.productCountColorValue),t}(e),p={priceColor:{label:(0,R.__)("Price","woocommerce"),context:"price-color"},iconColor:{label:(0,R.__)("Icon","woocommerce"),context:"icon-color"},productCountColor:{label:(0,R.__)("Product Count","woocommerce"),context:"product-count-color"}},m=(0,O.useBlockProps)({className:"wc-block-mini-cart"}),g=(e=>{if(!(e=>null===e)(t=e)&&t instanceof Object&&t.constructor===Object){const t=e.getEditedPostType();return"wp_template"===t||"wp_template_part"===t}var t;return!1})((0,B.select)("core/edit-site")),C=(0,i.getSetting)("templatePartEditUri","");return(0,r.createElement)("div",{...m},(0,r.createElement)(O.InspectorControls,null,(0,r.createElement)(x.PanelBody,{title:(0,R.__)("Settings","woocommerce")},(0,r.createElement)(x.__experimentalToggleGroupControl,{className:"wc-block-editor-mini-cart__cart-icon-toggle",isBlock:!0,label:(0,R.__)("Cart Icon","woocommerce"),value:d,onChange:e=>{t({miniCartIcon:e})}},(0,r.createElement)(x.__experimentalToggleGroupControlOption,{value:"cart",label:(0,r.createElement)(c.Z,{size:32,icon:M})}),(0,r.createElement)(x.__experimentalToggleGroupControlOption,{value:"bag",label:(0,r.createElement)(c.Z,{size:32,icon:j})}),(0,r.createElement)(x.__experimentalToggleGroupControlOption,{value:"bag-alt",label:(0,r.createElement)(c.Z,{size:32,icon:Z})})),(0,r.createElement)(x.BaseControl,{id:"wc-block-mini-cart__display-toggle",label:(0,R.__)("Display","woocommerce")},(0,r.createElement)(x.ToggleControl,{label:(0,R.__)("Display total price","woocommerce"),help:(0,R.__)("Toggle to display the total price of products in the shopping cart. If no products have been added, the price will not display.","woocommerce"),checked:!n,onChange:()=>t({hasHiddenPrice:!n})})),g&&(0,r.createElement)(x.__experimentalToggleGroupControl,{className:"wc-block-editor-mini-cart__render-in-cart-and-checkout-toggle",label:(0,R.__)("Mini-Cart in cart and checkout pages","woocommerce"),value:o,onChange:e=>{t({cartAndCheckoutRenderStyle:e})},help:(0,R.__)("Select how the Mini-Cart behaves in the Cart and Checkout pages. This might affect the header layout.","woocommerce")},(0,r.createElement)(x.__experimentalToggleGroupControlOption,{value:"hidden",label:(0,R.__)("Hide","woocommerce")}),(0,r.createElement)(x.__experimentalToggleGroupControlOption,{value:"removed",label:(0,R.__)("Remove","woocommerce")}))),(0,r.createElement)(x.PanelBody,{title:(0,R.__)("Cart Drawer","woocommerce")},C&&(0,r.createElement)(r.Fragment,null,(0,r.createElement)("img",{className:"wc-block-editor-mini-cart__drawer-image",src:(0,R.isRTL)()?`${_}blocks/mini-cart/cart-drawer-rtl.svg`:`${_}blocks/mini-cart/cart-drawer.svg`,alt:""}),(0,r.createElement)("p",null,(0,R.__)("When opened, the Mini-Cart drawer gives shoppers quick access to view their selected products and checkout.","woocommerce")),(0,r.createElement)("p",{className:"wc-block-editor-mini-cart__drawer-link"},(0,r.createElement)(x.ExternalLink,{href:C},(0,R.__)("Edit Mini-Cart Drawer template","woocommerce")))),(0,r.createElement)(x.BaseControl,{id:"wc-block-mini-cart__add-to-cart-behaviour-toggle",label:(0,R.__)("Behavior","woocommerce")},(0,r.createElement)(x.ToggleControl,{label:(0,R.__)("Open drawer when adding","woocommerce"),onChange:e=>{t({addToCartBehaviour:e?"open_drawer":"none"})},help:(0,R.__)("Toggle to open the Mini-Cart drawer when a shopper adds a product to their cart.","woocommerce"),checked:"open_drawer"===l})))),(0,r.createElement)(L,{colorTypes:p}),(0,r.createElement)(V,null,(0,r.createElement)("button",{className:"wc-block-mini-cart__button"},!n&&(0,r.createElement)("span",{className:"wc-block-mini-cart__amount",style:{color:a.color}},(0,T.formatPrice)(0)),(0,r.createElement)(N,{count:0,iconColor:s,productCountColor:u,icon:d}))))},save:()=>null}),(0,y.addFilter)("blocks.registerBlockType","woocommerce/mini-cart",(function(e,t){return"core/template-part"===t?{...e,variations:e.variations.map((e=>"mini-cart"===e.name?{...e,scope:[]}:e))}:e}))},7272:()=>{},9794:()=>{},5848:()=>{},9196:e=>{"use strict";e.exports=window.React},5904:e=>{"use strict";e.exports=window.wp.dom},9307:e=>{"use strict";e.exports=window.wp.element},5736:e=>{"use strict";e.exports=window.wp.i18n},444:e=>{"use strict";e.exports=window.wp.primitives}},o={};function r(e){var l=o[e];if(void 0!==l)return l.exports;var n=o[e]={exports:{}};return t[e].call(n.exports,n,n.exports,r),n.exports}r.m=t,e=[],r.O=(t,o,l,n)=>{if(!o){var c=1/0;for(u=0;u<e.length;u++){for(var[o,l,n]=e[u],a=!0,i=0;i<o.length;i++)(!1&n||c>=n)&&Object.keys(r.O).every((e=>r.O[e](o[i])))?o.splice(i--,1):(a=!1,n<c&&(c=n));if(a){e.splice(u--,1);var s=l();void 0!==s&&(t=s)}}return t}n=n||0;for(var u=e.length;u>0&&e[u-1][2]>n;u--)e[u]=e[u-1];e[u]=[o,l,n]},r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var o in t)r.o(t,o)&&!r.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.j=2398,(()=>{var e={2398:0};r.O.j=t=>0===e[t];var t=(t,o)=>{var l,n,[c,a,i]=o,s=0;if(c.some((t=>0!==e[t]))){for(l in a)r.o(a,l)&&(r.m[l]=a[l]);if(i)var u=i(r)}for(t&&t(o);s<c.length;s++)n=c[s],r.o(e,n)&&e[n]&&e[n][0](),e[n]=0;return r.O(u)},o=self.webpackChunkwebpackWcBlocksJsonp=self.webpackChunkwebpackWcBlocksJsonp||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var l=r.O(void 0,[2869],(()=>r(3090)));l=r.O(l),((this.wc=this.wc||{}).blocks=this.wc.blocks||{})["mini-cart"]=l})();