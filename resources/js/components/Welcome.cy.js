import Welcome from './Welcome.vue'

describe('<Welcome />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(Welcome)
  })
})