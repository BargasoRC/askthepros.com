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
  }
}
