/* eslint-disable */
export default{
  hasShownModal: false,
  industry: [
    {
      id: 1,
      category: 'Manufacturing',
      price: 190,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
      id: 2,
      category: 'Construction',
      price: 290,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting']
    },
    {
      id: 3,
      category: 'Finance',
      price: 199,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      id: 4,
      category: 'Transport',
      price: 192,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      id: 5,
      category: 'Agriculture',
      price: 100,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
      id: 6,
      category: 'Retail',
      price: 190,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      id: 7,
      category: 'Technology',
      price: 195,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
      id: 8,
      category: 'Education',
      price: 142,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      id: 9,
      category: 'Publishing',
      price: 132,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
      id: 10,
      category: 'Medicine',
      price: 122,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    }
  ],
  selectedIndustryIndex: null,
  validateEmail(email){
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  },
  validatePassword(password) {
    const re = /^(?=.*[0-9])(?=.*[- ?!@#$%^&*\/\\])(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9- ?!@#$%^&*\/\\]{8,16}$/
    return re.test(password)
  },
  validateField(input){
    const re = /^[A-Za-z.]{1,30}\s\d/
    return re.test(input)
  },
  validateNumber(number){
    const re = /^[0-9+]{11,13}/
    return re.test(number)
  },
  validateHTML(html){
    const re = /<(br|basefont|hr|input|source|frame|param|area|meta|!--|col|link|option|base|img|wbr|!DOCTYPE).*?>|<(a|abbr|acronym|address|applet|article|aside|audio|b|bdi|bdo|big|blockquote|body|button|canvas|caption|center|cite|code|colgroup|command|datalist|dd|del|details|dfn|dialog|dir|div|dl|dt|em|embed|fieldset|figcaption|figure|font|footer|form|frameset|head|header|hgroup|h1|h2|h3|h4|h5|h6|html|i|iframe|ins|kbd|keygen|label|legend|li|map|mark|menu|meter|nav|noframes|noscript|object|ol|optgroup|output|p|pre|progress|q|rp|rt|ruby|s|samp|script|section|select|small|span|strike|strong|style|sub|summary|sup|table|tbody|td|textarea|tfoot|th|thead|time|title|tr|track|tt|u|ul|var|video).*?<\/\2>/i
    return re.test(html)
  },
  validatePhoneNumber(pnumber){
    const re = /(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/img
    return re.test(pnumber)
  }
}
