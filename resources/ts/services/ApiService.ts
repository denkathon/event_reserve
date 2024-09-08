// src/services/ApiService.ts
const API_BASE_URL = 'http://localhost:8000/api'; // LaravelのAPIサーバーのURL

export const reserveEvent = async (data: { eventName: string, introduction: string, category: string }) => {
  try {
    const response = await fetch(`${API_BASE_URL}/reservations`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return await response.json();
  } catch (error) {
    console.error('Error:', error);
    throw error;
  }
};

