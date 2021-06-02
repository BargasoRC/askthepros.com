/* eslint-disable */
export default{
  hasShownModal: false,
  industry: [
    {
      category: 'Manufacturing',
      price: 190,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
      category: 'Construction',
      price: 290,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting']
    },
    {
      category: 'Finance',
      price: 199,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      category: 'Transport',
      price: 192,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      category: 'Agriculture',
      price: 100,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
      category: 'Retail',
      price: 190,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      category: 'Technology',
      price: 195,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
      category: 'Education',
      price: 142,
      benefit: ['Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin', 'Connect to GMB, Facebook & Linkedin']
    },
    {
      category: 'Publishing',
      price: 132,
      benefit: ['Connect to GMB', 'Automate Your GMB Posting', 'Connect to Facebook', 'Automate Your Facebook Posting', 'Connect to GMB, Facebook & Linkedin', 'Connect to Linkedin', 'Automate Your Linkedin Posting']
    },
    {
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
  }
}
