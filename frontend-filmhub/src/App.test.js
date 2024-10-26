import { render, screen } from '@testing-library/react';
import App from './App';
import Footer from './footer/Footer';

test('renders learn react link', () => {
  render(<App />);
  render(<Footer />);
  const linkElement = screen.getByText(/learn react/i);
  expect(linkElement).toBeInTheDocument();
});
