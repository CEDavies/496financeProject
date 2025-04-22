import TeachDashboard from './teachDashboard.vue'

describe('<TeachDashboard />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(TeachDashboard)
  })
})