import React, { useState } from 'react';
import Modal from './Modal';

interface ScheduleTableProps {
  weekDates: string[];
  reservations: number[][];
  onCellClick: (day: string, time: string) => void;
}

const ScheduleTable: React.FC<ScheduleTableProps> = ({ weekDates, reservations, onCellClick }) => {
  const times = ['11:00~12:00', '12:00~13:00', '13:00~14:00', '14:00~15:00', '15:00~16:00', '16:00~17:00', '17:00~18:00', '18:00~19:00', '19:0~20:00', '20:00~21:00', '21:00~22:00', '22:00~23:00'];

  return (
    <table>
      <thead>
        <tr>
          <th>時間</th>
          {weekDates.map((date, index) => (
            <th key={index}>{date}</th>
          ))}
        </tr>
      </thead>
      <tbody>
        {times.map((time, rowIndex) => (
          <tr key={rowIndex}>
            <td>{time}</td>
            {reservations[rowIndex].map((reservation, colIndex) => (
              <td
                key={colIndex}
                onClick={() => onCellClick(weekDates[colIndex], time)}
                style={{ backgroundColor: reservation === 1 ? 'lightgreen' : 'white' }}
              >
                {reservation}
              </td>
            ))}
          </tr>
        ))}
      </tbody>
    </table>
  );
};

export default ScheduleTable;