import Signup from './Signup.vue'

describe('<Signup />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(Signup)
  })
})